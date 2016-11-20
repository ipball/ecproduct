<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$sql_pd = "SELECT p.*, c.name as cname, c.id as cid FROM products p ";
$sql_pd .= "INNER JOIN product_categories c ";
$sql_pd .= "ON p.product_categorie_id=c.id ";
$sql_pd .= "WHERE p.id='{$_GET['id']}' ";
$query_pd = $db->query($sql_pd);
$rs_pd = $db->get($query_pd);

$option_ps = array(
    "table" => "products",
    "fields" => "id,name,price,image",
    "condition" => "product_categorie_id='{$rs_pd['cid']}'",
    "limit" => 5
);
$query_ps = $db->select($option_ps);
/*
 * php code///////////**********************************************************
 */
$title = $rs_pd['name'];

/*
 * header***********************************************************************
 */
require 'template/front/header.php';
/*
 * header***********************************************************************
 */
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/imagelightbox.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.form-validator.min.js"></script>
<style>
    #imagelightbox
    {
        position: fixed;
        z-index: 9999;

        -ms-touch-action: none;
        touch-action: none;
    }
</style>
<div class="container">

    <div class="blog-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">หน้าแรก</a></li>
            <li><a href="<?php echo base_url(); ?>/categorie/<?php echo $rs_pd['cid']; ?>"><?php echo $rs_pd['cname']; ?></a></li>
            <li class="active"><?php echo $rs_pd['name']; ?></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-9 blog-main">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="<?php echo base_url(); ?>/upload/product/<?php echo $rs_pd['image']; ?>" data-imagelightbox="a">
                                <img src="<?php echo base_url(); ?>/upload/product/thumb_<?php echo $rs_pd['image']; ?>" class="img-responsive" alt="Responsive image">
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <h3><?php echo $rs_pd['name']; ?></h3>
                            <dl class="dl-horizontal">
                                <dt>ยี่ห้อ</dt>
                                <dd><?php echo $rs_pd['brandname']; ?></dd>
                                <dt>ราคา</dt>
                                <dd><?php echo number_format($rs_pd['price'], 2); ?></dd>
                            </dl>
                            <hr>
                            <form class="form-inline" role="form" action="<?php echo base_url();?>/cart/update/<?php echo $rs_pd['id'];?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="text2" autocomplete="off" name="qty" placeholder="ใส่จำนวน" data-validation="number" data-validation-allowing="float">
                                </div>
                                <button type="submit" class="btn btn-success">หยิบใส่ตะกร้า</button>
                            </form>
                        </div>
                    </div>
                    <div class="row" style="font-size: 14px;">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="#" onclick="return false;">รายละเอียด</a></li>
                            </ul>
                            <?php echo $rs_pd['detail']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.blog-main -->
        <div class="col-sm-3 blog-sidebar">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">สินค้าที่เกี่ยวข้อง</div>
                <!-- List group -->
                <ul class="list-group">
                    <?php while ($rs_ps = $db->get($query_ps)) { ?>
                        <li class="list-block">
                            <a href="<?php echo $baseUrl; ?>/product/view/<?php echo $rs_ps['id']; ?>">
                                <img src="<?php echo base_url(); ?>/upload/product/sm_<?php echo $rs_ps['image']; ?>" class="img-responsive" alt="Responsive image">
                                <?php echo $rs_ps['name']; ?>
                                (<?php echo $rs_ps['price']; ?> บาท)
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</div><!-- /.container -->
<script type="text/javascript">
    $(document).ready(function () {
        $('a').imageLightbox();
        $.validate();
    });
</script>
<?php
/*
 * footer***********************************************************************
 */
require 'template/front/footer.php';
/*
 * footer***********************************************************************
 */
