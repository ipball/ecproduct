<?php
/*
 * include file start***********************************************************
 */
require 'library/pagination.php';
/*
 * php code///////////**********************************************************
 */
$title = 'ระบบจัดการร้านค้า : หมวดหมู่สินค้า';
$db = new database();
$pagination = new Zebra_Pagination();

$sql_pc = "SELECT * FROM product_categories WHERE 1=1 ";

$sql_pc .= isset($_GET['name']) ? "AND name LIKE '%{$_GET['name']}%' " : "";

$query_pc = $db->query($sql_pc);
$rows_pc = $db->rows($query_pc);

$per_page = 20;
$page_start = (($pagination->get_page() - 1) * $per_page);
$sql_pc .= "ORDER BY id DESC LIMIT {$page_start},{$per_page} ";
$pagination->records($rows_pc);
$pagination->records_per_page($per_page);
$pagination->base_url('', FALSE);
$query_pc_page = $db->query($sql_pc);

$page = ($page_start!=0) ? $page_start : "1";
$pages = ceil($rows_pc/$per_page);

$uri = $_SERVER['REQUEST_URI']; // url

/*
 * php code///////////**********************************************************
 */

/*
 * header***********************************************************************
 */
require 'template/back/header.php';
/*
 * header***********************************************************************
 */
?>

<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">จัดการหมวดหมู่สินค้า</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" class="btn btn-success btn-xs new-data"
                   href="<?php echo $baseUrl; ?>/back/productcategorie/create">
                    <i class="glyphicon glyphicon-plus-sign"></i>
                    เพิ่มใหม่
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="#">
                    <i class="glyphicon glyphicon-search"></i>
                    ค้นหาขั้นสูง
                </a>
                <a role="button" class="btn btn-default btn-xs"
                   href="<?php echo $baseUrl; ?>/back/productcategorie">
                    <i class="glyphicon glyphicon-refresh"></i>
                    โหลดหน้าจอใหม่
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="search-form" style="display:none">

                <form id="yw0" action="<?php echo $baseUrl; ?>/back/productcategorie/index" method="get">
                    <div class="form-horizontal" style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">ชื่อหมวดหมู่สินค้า</label>
                            <div class="col-sm-4">
                                <input class="form-control input-sm" name="name" id="name" type="text" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-primary searchbtn"><i class="glyphicon glyphicon-search"></i> ค้นหาเดี๋ยวนี้!</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- search-form -->
            <div id="user-grid" class="grid-view">
                <div class="summary">หน้า <?php echo $page;?> จากทั้งหมด <?php echo $pages; ?> หน้า</div>
                <table class="table table-striped table-custom">
                    <thead>
                        <tr>
                            <th id="user-grid_c0">
                                <a class="sort-link" href="<?php echo $uri; ?>">หมวดหมู่สินค้า</a>
                            </th>
                            <th id="user-grid_c1">
                                <a class="sort-link" href="<?php echo $uri; ?>">รหัส</a>
                            </th>
                            <th id="user-grid_c4">
                                <a class="sort-link" href="<?php echo $uri; ?>">สร้าง</a>
                            </th>
                            <th class="button-column" id="user-grid_c6">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($rs_pc = $db->get($query_pc_page)) {
                            $tr = ($i % 2 == 0) ? "odd" : "even";
                            ?>
                            <tr class="<?php echo $tr; ?>">
                                <td>
                                    <a class="load_data" href="<?php echo $baseUrl; ?>/back/productcategorie/update/<?php echo $rs_pc['id']; ?>"><?php echo $rs_pc['name']; ?></a>
                                </td>
                                <td><?php echo $rs_pc['codename']; ?></td>
                                <td><?php echo thaidate($rs_pc['created']); ?></td>
                                <td class="button-column">
                                    <a class="btn btn-warning btn-xs load_data" title="" href="<?php echo $baseUrl; ?>/back/productcategorie/update/<?php echo $rs_pc['id']; ?>"><i class="glyphicon glyphicon-edit"></i> แก้ไข</a>
                                    <a class="btn btn-danger btn-xs confirm" title="" href="#" data-toggle="modal" data-target="#deleteModal<?php echo $rs_pc['id'];?>"><i class="glyphicon glyphicon-remove"></i> ลบ</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $rs_pc['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">แจ้งเตือนการลบข้อมูล</h4>
                                                </div>
                                                <div class="modal-body">
                                                    คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ไม่ใช่</button>
                                                    <a role="button" class="btn btn-primary" href="<?php echo $baseUrl; ?>/back/productcategorie/delete/<?php echo $rs_pc['id']; ?>">ใช่ ยืนยันการลบ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <?php $pagination->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
          <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
              <ul class="pagination"><li class="paginate_button active"><a tabindex="0" data-dt-idx="1" aria-controls="itoffside.com" href="#">1</a></li><li class="paginate_button"><a data-ci-pagination-page="2" href="http://localhost/stock/flowprint/index/14">2</a></li><li class="paginate_button next"><a rel="next" data-ci-pagination-page="2" href="http://localhost/stock/flowprint/index/14">Next</a></li></ul>                            </div>

      </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.search-button').click(function () {
                $('.search-form').toggle();
                return false;
            });
        });
    </script>
</div>

<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */
mysql_close();
