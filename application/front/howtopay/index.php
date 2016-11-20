<?php
/*
 * php code///////////**********************************************************
 */
$title = 'วิธีการสั่งซื้อ';

$db = new database();
$option_cat = array(
    "table" => "product_categories"
);
$query_cat = $db->select($option_cat); // catgorie

$option_py = array(
    "table" => "contents",
    "condition" => "codename='howtopay'"
);
$query_py = $db->select($option_py); // pygorie
$rs_py = $db->get($query_py);

/*
 * php code///////////**********************************************************
 */

/*
 * header***********************************************************************
 */
require 'template/front/header.php';
/*
 * header***********************************************************************
 */
?>
<div class="container">
    <div class="blog-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">หน้าแรก</a></li>
            <li class="active">วิธีการสั่งซื้อ</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-3 blog-sidebar">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">ประเภทสินค้า</div>
                <!-- List group -->
                <ul class="list-group">
                    <?php
                    while ($rs_cat = $db->get($query_cat)) {
                        ?>
                        <li class="list-block"><a href="<?php echo $baseUrl; ?>/categorie/<?php echo $rs_cat['id']; ?>"><?php echo $rs_cat['name']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div><!-- /.blog-sidebar -->

        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo $rs_py['detail']; ?>
                </div>
            </div>
        </div><!-- /.blog-main -->

    </div><!-- /.row -->

</div><!-- /.container -->
<?php
/*
 * footer***********************************************************************
 */
require 'template/front/footer.php';
/*
 * footer***********************************************************************
 */