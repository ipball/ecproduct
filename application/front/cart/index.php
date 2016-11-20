<?php
/*
 * php code///////////**********************************************************
 */
$db = new database();
$title = 'ตะกร้าสั่งซื้อสินค้า';
$item_count = isset($_SESSION[_ss . 'cart']) ? count($_SESSION[_ss . 'cart']) : 0;
if (isset($_SESSION[_ss . 'qty'])) {
    $me_qty = 0;
    foreach ($_SESSION[_ss . 'qty'] as $me_item) {
        $me_qty = $me_qty + $me_item;
    }
} else {
    $me_qty = 0;
}

if (isset($_SESSION[_ss . 'cart']) and $item_count > 0) {
    $items_id = "";
    foreach ($_SESSION[_ss . 'cart'] as $item_id) {
        $items_id = $items_id . $item_id . ",";
    }
    $input_item = rtrim($items_id, ",");
    $option_ct = array(
        "table" => "products",
        "condition" => "id IN ({$input_item})"
    );
    $query_ct = $db->select($option_ct);
    $me_count = $db->rows($query_ct);
} else {
    $me_count = 0;
}


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
            <li class="active">ตะกร้าสินค้า</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12 blog-main">
            <div class="row" style="font-size:13px;">
                <?php if ($me_count > 0) { ?>
                <form action="<?php echo base_url();?>/cart/update/0" method="post" name="cartform" id="cartform">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รูปสินค้า</th>
                                <th>สินค้า</th>
                                <th style="text-align:center;">ราคา/หน่วย</th>
                                <th style="width: 100px;text-align: center;">จำนวน</th>
                                <th style="text-align:center;">จำนวนเงินรวม</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $total_price = 0;
                            while ($rs_ct = $db->get($query_ct)) {
                                $key = array_search($rs_ct['id'], $_SESSION[_ss . 'cart']);
                                $total_price = $total_price + ($rs_ct['price'] * $_SESSION[_ss . 'qty'][$key]);
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo base_url(); ?>/upload/product/<?php echo $rs_ct['image']; ?>" data-imagelightbox="a">
                                            <img src="<?php echo base_url(); ?>/upload/product/sm_<?php echo $rs_ct['image']; ?>" class="img-responsive" alt="Responsive image">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>/product/view/<?php echo $rs_ct['id']; ?>">
                                            <?php echo $rs_ct['name']; ?>
                                        </a>
                                    </td>
                                    <td style="text-align:right;">
                                        <?php echo number_format($rs_ct['price'], 2); ?>
                                    </td>
                                    <td>
                                        <input style="text-align:center;" type="text" name="qtyupdate[<?php echo $i;?>]" value="<?php echo $_SESSION[_ss . 'qty'][$key]; ?>" class="form-control input-sm" autocomplete="off" data-validation="number" data-validation-allowing="float">
                                        <input type="hidden" name="arr_key_<?php echo $i;?>" value="<?php echo $key;?>">
                                    </td>
                                    <td style="text-align:right;">
                                        <?php echo number_format($rs_ct['price'] * $_SESSION[_ss . 'qty'][$key], 2); ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <button type="button" data-toggle="modal" data-target="#deleteModal<?php echo $rs_ct['id']; ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            ลบทิ้ง
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $rs_ct['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <a role="button" class="btn btn-primary" href="<?php echo $baseUrl; ?>/cart/delete/<?php echo $rs_ct['id']; ?>">ใช่ ยืนยันการลบ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; } ?>
                        <tr>
                            <td colspan="6" style="text-align: right;">
                                <h4>จำนวนเงินรวมทั้งหมด <?php echo number_format($total_price); ?> บาท</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right;">
                                <button type="button" class="btn btn-primary recal">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    คำนวณสินค้าใหม่
                                </button>
                                <button type="button" class="btn btn-success ordercart">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    สั่งซื้อสินค้า
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert" style="margin:15px;">
                        ไม่มีสินค้าในตะกร้าสินค้า หากต้องการซื้อสินค้า
                        <a href="<?php echo base_url(); ?>/product" class="alert-link">คลิกที่นี้</a>
                    </div>
                <?php } ?>
            </div>
        </div><!-- /.blog-main -->

    </div><!-- /.row -->

</div><!-- /.container -->
<script type="text/javascript">
    $(document).ready(function () {
        $('a').imageLightbox();
        $.validate();
        $('.recal').click(function(){
           $('#cartform').submit(); 
        });
        $('.ordercart').click(function(){
            window.location = 'deliveryinformation';
        });
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
