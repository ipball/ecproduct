<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$option_pc = array(
    "table" => "product_categories",
    "condition" => "id='{$_GET['id']}' "
);
$query_pc = $db->select($option_pc);
$rs_pc = $db->get($query_pc);

$title = 'แก้ไขหมวดหมู่สินค้า : ' .$rs_pc['name'];
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
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.form-validator.min.js"></script>
<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แก้ไขข้อมูล <?php echo $rs_pc['name']; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" id="save" class="btn btn-success btn-xs new-data" href="#">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    บันทึก
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="<?php echo $baseUrl; ?>/back/productcategorie">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    ยกเลิก
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-horizontal" style="margin-top: 10px;">
                <form id="product-form" action="<?php echo $baseUrl; ?>/back/productcategorie/form_update" method="post">
                    <input type="hidden" name="id" value="<?php echo $rs_pc['id'];?>">
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ชื่อหมวดหมู่สินค้า <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="name" name="name" class="form-control input-sm" data-validation="required" value="<?php echo $rs_pc['name']; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">รหัส <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="codename" name="codename" class="form-control input-sm" data-validation="required" value="<?php echo $rs_pc['codename']; ?>">
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
            $("#product-form").submit();
            return false;
        });
    });
    $.validate();
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
