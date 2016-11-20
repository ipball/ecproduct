<?php
/*
 * php code///////////**********************************************************
 */
if (isset($_SESSION[_ss . 'msg_result'])) {
    $msg_result = $_SESSION[_ss . 'msg_result'];
    unset($_SESSION[_ss . 'msg_result']);
} else {
    $msg_result = false;
}
$db = new database();
$option_py = array(
    "table" => "contents",
    "condition" => "codename='howtopay' "
);
$query_py = $db->select($option_py);
$rs_py = $db->get($query_py);

$title = 'วิธีการสั่งซื้อสินค้า';
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
<script type="text/javascript" src="<?php echo $baseUrl; ?>/ckeditor/ckeditor.js"></script>
<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">วิธีการสั่งซื้อสินค้า</h1>
        </div>
        <?php if ($msg_result == true) { ?>
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    บันทึกรายการสำเร็จ!
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" id="save" class="btn btn-success btn-xs new-data" href="#">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    บันทึก
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="<?php echo $baseUrl; ?>/back/home/index">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    ยกเลิก
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-horizontal" style="margin-top: 10px;">
                <form id="payment-form" action="<?php echo $baseUrl; ?>/back/howtopay/form_index" method="post">
                    <input type="hidden" name="id" value="<?php echo $rs_py['id']; ?>">
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ชื่อหัวข้อ <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="name" readonly="" name="name" class="form-control input-sm" data-validation="required" value="<?php echo $rs_py['topic']; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" class="form-control input-sm"><?php echo $rs_py['detail']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace('detail');
                                function CKupdate() {
                                    for (instance in CKEDITOR.instances)
                                        CKEDITOR.instances[instance].updateElement();
                                }
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#save").click(function () {
            $("#payment-form").submit();
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

mysql_close();
