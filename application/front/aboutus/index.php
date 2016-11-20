<?php
/*
 * php code///////////**********************************************************
 */
$title = 'เกี่ยวกับเรา';

$db = new database();
$option_cat = array(
    "table" => "product_categories"
);
$query_cat = $db->select($option_cat); // catgorie

$option_py = array(
    "table" => "contents",
    "condition" => "codename='aboutus'"
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
            <li class="active">เกี่ยวกับเรา</li>
        </ol>
    </div>
    <div class="row">

        <div class="col-sm-12">
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
