<?php
/*
 * php code///////////**********************************************************
 */
$title = 'ระบบจัดการร้านค้า : ผู้ใช้';
$db = new database();
$option_user = array(
    "table" => "users",
    "condition" => "username != 'guest'"
);
$query_user = $db->select($option_user);

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
            <h1 class="page-header">จัดการผู้ใช้</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" class="search-button btn btn-default btn-xs" href="#">
                    <i class="glyphicon glyphicon-search"></i>
                    ค้นหา ขั้นสูง
                </a>
                <a role="button" class="btn btn-default btn-xs" 
                   href="<?php echo $baseUrl; ?>/back/user">
                    <i class="glyphicon glyphicon-refresh"></i>
                    โหลดหน้าจอใหม่
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="search-form" style="display:none">

                <form id="yw0" action="<?php echo $baseUrl; ?>/back/user/index" method="get"><div class="form-horizontal" style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="Username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-4">
                                <input size="50" maxlength="50" class="form-control input-sm" name="User[username]" id="User_username" type="text" />        </div>
                        </div>

                        <div class="form-group">
                            <label for="Username" class="col-sm-2 control-label">ชื่อจริง</label>
                            <div class="col-sm-4">
                                <input size="60" maxlength="100" class="form-control input-sm" name="User[firstname]" id="User_firstname" type="text" />        </div>
                        </div>

                        <div class="form-group">
                            <label for="Username" class="col-sm-2 control-label">นามสกุล</label>
                            <div class="col-sm-4">
                                <input size="60" maxlength="100" class="form-control input-sm" name="User[lastname]" id="User_lastname" type="text" />        </div>
                        </div>

                        <div class="form-group">
                            <label for="Username" class="col-sm-2 control-label">ประเภท</label>
                            <div class="col-sm-4">
                                <select class="form-control input-sm" name="User[user_type]" id="User_user_type">
                                    <option value="" selected="selected">All</option>
                                    <option value="user">ผู้ใช้</option>
                                    <option value="admin">ผู้ดูแลระบบ</option>
                                </select>
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
                <table class="table table-striped table-custom">
                    <thead>
                        <tr>
                            <th id="user-grid_c0">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=username">Username</a>
                            </th>
                            <th id="user-grid_c1">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=firstname">ชื่อจริง</a>
                            </th>
                            <th id="user-grid_c2">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=lastname">นามสกุล</a>
                            </th><th id="user-grid_c3">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=province">จังหวัด</a>
                            </th><th id="user-grid_c4">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=user_type">ประเภท</a>
                            </th>
                            <th id="user-grid_c5">
                                <a class="sort-link" href="<?php echo $baseUrl; ?>/back/user/index?User_sort=created">สร้าง</a>
                            </th>
                            <th class="button-column" id="user-grid_c6">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($rs_user = $db->get($query_user)) {
                            $tr = ($i % 2 == 0) ? "odd" : "even";
                            ?>
                            <tr class="<?php echo $tr; ?>">
                                <td>
                                    <a class="load_data" href="<?php echo $baseUrl; ?>/back/user/<?php echo $rs_user['id']; ?>"><?php echo $rs_user['username']; ?></a>
                                </td>
                                <td><?php echo $rs_user['firstname']; ?></td>
                                <td><?php echo $rs_user['lastname']; ?></td>
                                <td><?php echo $rs_user['province']; ?></td>
                                <td><?php echo $rs_user['user_type']; ?></td>
                                <td><?php echo thaidate($rs_user['created']); ?></td>
                                <td class="button-column">
                                    <a class="btn btn-info btn-xs load_data" title="" href="<?php echo $baseUrl; ?>/back/user/<?php echo $rs_user['id']; ?>"><i class="glyphicon glyphicon-zoom-in"></i> รายละเอียด</a>
                                    <a class="btn btn-warning btn-xs load_data" title="" href="<?php echo $baseUrl; ?>/back/user/update/<?php echo $rs_user['id']; ?>"><i class="glyphicon glyphicon-edit"></i> แก้ไข</a>
                                    <a class="btn btn-danger btn-xs confirm" title="" href="#" data-toggle="modal" data-target="#deleteModal<?php echo $rs_user['id'];?>"><i class="glyphicon glyphicon-remove"></i> ลบ</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $rs_user['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    <a role="button" class="btn btn-primary" href="<?php echo $baseUrl; ?>/back/user/delete/<?php echo $rs_user['id']; ?>">ใช่ ยืนยันการลบ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="keys" style="display:none" title="<?php echo $baseUrl; ?>/back/user"><span>2</span><span>3</span></div>
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