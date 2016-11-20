<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$option_pc = array(
    "table" => "product_categories"
);
$query_pc = $db->select($option_pc);


$title = 'เพิ่มสินค้าใหม่';
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
<script type="text/javascript" src="<?php echo $baseUrl; ?>/ckeditor/ckeditor.js"></script>
<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">เพิ่มข้อมูลใหม่</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" id="save" class="btn btn-success btn-xs new-data" href="#">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    บันทึก
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="<?php echo $baseUrl; ?>/back/product">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    ยกเลิก
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-horizontal" style="margin-top: 10px;">
                <form id="product-form" action="<?php echo $baseUrl; ?>/back/product/form_create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Product_product_categorie_id" class="col-sm-2 control-label required">หมวดหมู่<span class="required">*</span></label>
                        <div class="col-sm-4">
                            <select id="product_categorie_id" name="product_categorie_id" class="form-control input-sm">
                                <?php while ($rs_pc = $db->get($query_pc)) { ?>
                                    <option value="<?php echo $rs_pc['id']; ?>"><?php echo $rs_pc['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_image" class="col-sm-2 control-label">รูปภาพ</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ชื่อสินค้า <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="name" name="name" class="form-control input-sm" data-validation="required" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ราคาสินค้า <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="price" name="price" class="form-control input-sm" data-validation="number" data-validation-allowing="float">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ยีห้อ <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="brandname" name="brandname" class="form-control input-sm" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" class="form-control input-sm"></textarea>
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
