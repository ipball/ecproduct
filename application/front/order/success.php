<?php
if ($_SERVER['HTTP_REFERER'] != base_url() . "/order" OR $_SESSION[_ss . 'mform'] != "itoffside.com") {
    header("location:" . base_url());
}
unset($_SESSION[_ss . 'mform']);
/*
 * php code///////////**********************************************************
 */
$title = 'ทำรายการสั่งซื้อสำเร็จ';

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
            <li><a href="#">ตะกร้าสินค้า</a></li>
            <li><a href="#">สั่งซื้อสินค้า</a></li>
            <li class="active">สั่งซื้อสินค้า</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12 blog-main">
            <div class="row" style="font-size:13px;">
                <div class="alert alert-success" role="alert" style="margin:15px;">
                    <p><strong>ทำรายการสั่งซื้อสำเร็จ!</strong></p>
                    <p>หมายเลขสั่งซื้อของคุณคือ <strong><?php echo $_SESSION[_ss . 'order_id'];?></strong></p>
                    <p>หากต้องการกลับหน้าแรก
                        <a href="<?php echo base_url(); ?>" class="alert-link">คลิกที่นี้</a></p>
                </div>
            </div>
        </div><!-- /.blog-main -->

    </div><!-- /.row -->

</div><!-- /.container -->
<?php
/*
 * footer***********************************************************************
 */
unset($_SESSION[_ss . 'order_id']);
require 'template/front/footer.php';
/*
 * footer***********************************************************************
 */