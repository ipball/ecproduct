<?php
/*
 * include file start***********************************************************
 */
require 'library/pagination.php';
/*
 * php code///////////**********************************************************
 */
$title = 'ระบบจัดการร้านค้า : รายการสั่งซื้อสินค้า';
$db = new database();
$pagination = new Zebra_Pagination();

$order_id = isset($_GET['order_id'])? "AND id='{$_GET['order_id']}'" : "";

$sql_or = "SELECT o.id,o.order_date,o.total,o.fullname,o.user_id,o.order_status FROM orders o ";
$sql_or .= "WHERE 1=1 {$order_id}";

$sql_or .= isset($_GET['name']) ? "AND name LIKE '%{$_GET['name']}%' " : "";

$query_or = $db->query($sql_or);
$rows_pc = $db->rows($query_or);

$per_page = 20;
$page_start = (($pagination->get_page() - 1) * $per_page);
$sql_or .= "ORDER BY id DESC LIMIT {$page_start},{$per_page} ";
$pagination->records($rows_pc);
$pagination->records_per_page($per_page);
$pagination->base_url('', FALSE);
$query_or_page = $db->query($sql_or);

$page = ($page_start != 0) ? $page_start : "1";
$pages = ceil($rows_pc / $per_page);

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
            <h1 class="page-header">รายการสั่งซื้อสินค้า</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" class="search-button btn btn-default btn-xs" href="#">
                    <i class="glyphicon glyphicon-search"></i>
                    ค้นหาขั้นสูง
                </a>
                <a role="button" class="btn btn-default btn-xs" 
                   href="<?php echo $baseUrl; ?>/back/order">
                    <i class="glyphicon glyphicon-refresh"></i>
                    โหลดหน้าจอใหม่
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="search-form" style="display:none">

                <form id="yw0" action="<?php echo $baseUrl; ?>/back/order/index" method="get">
                    <div class="form-horizontal" style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">รหัสสั่งซื้อ</label>
                            <div class="col-sm-4">
                                <input class="form-control input-sm" name="order_id" id="order_id" type="text" />
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
                <div class="summary">หน้า <?php echo $page; ?> จากทั้งหมด <?php echo $pages; ?> หน้า</div>
                <table class="table table-striped table-custom">
                    <thead>
                        <tr>
                            <th id="user-grid_c0">
                                <a class="sort-link" href="<?php echo $uri; ?>">สถานะ</a>
                            </th>
                            <th id="user-grid_c1">
                                <a class="sort-link" href="<?php echo $uri; ?>">รหัสสั่งซื้อ</a>
                            </th>
                            <th id="user-grid_c4">
                                <a class="sort-link" href="<?php echo $uri; ?>">วันที่สั่งซื้อ</a>
                            </th>
                            <th id="user-grid_c4">
                                <a class="sort-link" href="<?php echo $uri; ?>">ผู้สั่งซื้อ</a>
                            </th>
                            <th id="user-grid_c4" style="text-align: right;">
                                <a class="sort-link" href="<?php echo $uri; ?>">ราคา(บาท)</a>
                            </th>
                            <th class="button-column" id="user-grid_c6">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($rs_or = $db->get($query_or_page)) {
                            $tr = ($i % 2 == 0) ? "odd" : "even";
                            //สถานะ
                            switch ($rs_or['order_status']) {
                                case 'pending':
                                    $order_status = 'ยังไม่ชำระเงิน';
                                    $btnorder = 'แจ้งชำระเงิน';
                                    $btnstat = '';
                                    break;
                                case 'payments':
                                    $order_status = 'กำลังจัดส่งสินค้า';
                                    $btnorder = 'ชำระเงินแล้ว';
                                    $btnstat = 'disabled';
                                    break;
                                case 'shipping':
                                    $order_status = 'จัดส่งสินค้าแล้ว';
                                    $btnorder = 'ชำระเงินแล้ว';
                                    $btnstat = 'disabled';
                                    break;
                                case 'deliver':
                                    $order_status = 'รับสินค้าแล้ว';
                                    $btnorder = 'ชำระเงินแล้ว';
                                    $btnstat = 'disabled';
                                    break;
                                default:
                                    $order_status = 'ผิดพลาด';
                                    $btnorder = '-';
                                    $btnstat = 'disabled';
                                    break;
                            }
                            ?>
                            <tr class="<?php echo $tr; ?>">
                                <td><?php echo $order_status; ?></td>
                                <td>
                                    <a class="load_data" href="<?php echo $baseUrl; ?>/back/order/view/<?php echo $rs_or['id']; ?>"><?php echo $rs_or['id']; ?></a>
                                </td>
                                <td><?php echo thaidate($rs_or['order_date']); ?></td>
                                <td><?php echo $rs_or['fullname'];?></td>
                                <td style="text-align: right;"><?php echo number_format($rs_or['total'],2); ?></td>
                                <td class="button-column">
                                    <a class="btn btn-warning btn-xs load_data <?php echo $btnstat;?>" title="" href="<?php echo $baseUrl; ?>/back/order/payment/<?php echo $rs_or['id']; ?>"><i class="glyphicon glyphicon-usd"></i> <?php echo $btnorder;?></a>
                                    <a class="btn btn-info btn-xs load_data" title="" href="<?php echo $baseUrl; ?>/back/order/view/<?php echo $rs_or['id']; ?>"><i class="glyphicon glyphicon-zoom-in"></i> รายละเอียด</a>
                                    <a class="btn btn-danger btn-xs confirm" title="" href="#" data-toggle="modal" data-target="#deleteModal<?php echo $rs_or['id']; ?>"><i class="glyphicon glyphicon-remove"></i> ลบ</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $rs_or['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a role="button" class="btn btn-primary" href="<?php echo $baseUrl; ?>/back/order/delete/<?php echo $rs_or['id']; ?>">ใช่ ยืนยันการลบ</a>
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
