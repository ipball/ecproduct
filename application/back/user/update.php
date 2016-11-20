<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$option_user = array(
    "table" => "users",
    "condition" => "id='{$_GET['id']}'"
);
$query_user = $db->select($option_user);
$rs_user = $db->get($query_user);


$title = 'แก้ไขผู้ใช้งาน : ' . $rs_user['username'];
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
            <h1 class="page-header">แก้ไขข้อมูล <?php echo $rs_user['username']; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" id="save" class="btn btn-success btn-xs new-data" href="#">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    Save
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="<?php echo $baseUrl; ?>/back/user">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    Cancel
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-horizontal" style="margin-top: 10px;">
                <form id="user-form" action="<?php echo $baseUrl; ?>/back/user/form_update/<?php echo $rs_user['id']; ?>" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label required" for="User_firstname">ชื่อจริง <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input maxlength="100" class="form-control input-sm" name="firstname" id="firstname" type="text" value="<?php echo $rs_user['firstname'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required" for="User_lastname">นามสกุล <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input maxlength="100" class="form-control input-sm" name="lastname" id="lastname" type="text" value="<?php echo $rs_user['lastname'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label required" for="User_username">Username <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="50" name="username" id="username" type="text" value="<?php echo $rs_user['username'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_email">อีเมล์</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="100" name="email" id="email" type="text" value="<?php echo $rs_user['email'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_phone">โทรศัพท์</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="20" name="phone" id="phone" type="text" value="<?php echo $rs_user['phone'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_address">ที่อยู่</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="200" name="address" id="address" type="text" value="<?php echo $rs_user['address'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_district">อำเภอ</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="100" name="district" id="district" type="text" value="<?php echo $rs_user['district'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_province">จังหวัด</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="100" name="province" id="province" type="text" value="<?php echo $rs_user['province'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_postcode">รหัสไปรษณีย์</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm" maxlength="5" name="postcode" id="postcode" type="text" value="<?php echo $rs_user['postcode'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="User_user_type">ประเภทสมาชิก</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" name="user_type" id="user_type">
                                <option value="user" selected="selected">ผู้ใช้ทั่วไป</option>
                                <option value="admin">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#save").click(function() {
            $("#user-form").submit();
            return false;
        });
    });
</script>
<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */