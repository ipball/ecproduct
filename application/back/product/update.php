<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$option_pc = array(
    "table" => "product_categories"
);
$query_pc = $db->select($option_pc);

$option_pd = array(
    "table" => "products",
    "condition" => "id='{$_GET['id']}' "
);
$query_pd = $db->select($option_pd);
$rs_pd = $db->get($query_pd);

$title = 'แก้ไขสินค้า : ' .$rs_pd['name'];
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
            <h1 class="page-header">แก้ไขข้อมูล <?php echo $rs_pd['name']; ?></h1>
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
                <form id="product-form" action="<?php echo $baseUrl; ?>/back/product/form_update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $rs_pd['id'];?>">
                    <div class="form-group">
                        <label for="product_image" class="col-sm-2 control-label required">รูปภาพประจำสินค้า</label>
                        <div class="col-sm-4">
                            <img src="<?php echo $baseUrl ?>/upload/product/md_<?php echo $rs_pd['image'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_product_categorie_id" class="col-sm-2 control-label required">หมวดหมู่<span class="required">*</span></label>
                        <div class="col-sm-4">
                            <select id="product_categorie_id" name="product_categorie_id" class="form-control input-sm">
                                <?php
                                while ($rs_pc = $db->get($query_pc)) { 
                                $spc = ($rs_pd['product_categorie_id']==$rs_pc['id']) ? "selected" : "";    
                                    ?>
                                    <option value="<?php echo $rs_pc['id']; ?>" <?php echo $spc; ?>><?php echo $rs_pc['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_image" class="col-sm-2 control-label">รูปภาพใหม่</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ชื่อสินค้า <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="name" name="name" class="form-control input-sm" data-validation="required" value="<?php echo $rs_pd['name']; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ราคาสินค้า <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="price" name="price" class="form-control input-sm" data-validation="number" data-validation-allowing="float" value="<?php echo $rs_pd['price']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-2 control-label required">ยีห้อ <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" id="brandname" name="brandname" class="form-control input-sm" data-validation="required" value="<?php echo $rs_pd['brandname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" class="form-control input-sm"><?php echo $rs_pd['detail']; ?></textarea>
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
