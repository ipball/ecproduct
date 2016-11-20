<?php
/*
 * php code///////////**********************************************************
 */
if (!isset($_GET['id'])) {
    header("location:" . $baseUrl . "/back/order");
}
$db = new database();
$sql_od = "SELECT d.*,p.id,p.name,p.image FROM order_details d INNER JOIN products p ";
$sql_od .= "ON d.product_id=p.id ";
$sql_od .="WHERE d.order_id='{$_GET['id']}' ";
$query_od = $db->query($sql_od);

$option_os = array(
    "table" => "orders",
    "condition" => "id='{$_GET['id']}'"
);
$query_os = $db->select($option_os);
$rows_os = $db->rows($query_os);
if($rows_os != 1){
    header("location:" . $baseUrl . "/back/order");
}else{
    $rs_os = $db->get($query_os);
}

$title = 'รายละเอียดการสั่งซื้อสินค้า';
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
            <h1 class="page-header">รายละเอียดการสั่งซื้อสินค้า</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" class="search-button btn btn-danger btn-xs" href="<?php echo $baseUrl; ?>/back/order">
                    <i class="glyphicon glyphicon-circle-arrow-left"></i>
                    ย้อนกลับ
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-horizontal" style="margin-top: 10px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ข้อมูลติดต่อและที่อยู่จัดสั่ง</h3>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ชื่อ-นามสกุล</strong> : <?php echo $rs_os['fullname'];?></li>
                        <li class="list-group-item"><strong>อีเมล์</strong> : <?php echo $rs_os['email'];?></li>
                        <li class="list-group-item"><strong>เบอร์โทรศัพท์</strong> : <?php echo $rs_os['phone'];?></li>
                        <li class="list-group-item"><strong>ที่อยู่</strong> : <?php echo $rs_os['address'];?></li>
                        <li class="list-group-item"><strong>อำเภอ</strong> : <?php echo $rs_os['district'];?></li>
                        <li class="list-group-item"><strong>จังหวัด</strong> : <?php echo $rs_os['province'];?></li>
                        <li class="list-group-item"><strong>รหัสไปรษณีย์</strong> : <?php echo $rs_os['postcode'];?></li>
                        <li class="list-group-item">*วันที่สั่งซื้อ <?php echo thaidate($rs_os['order_date']);?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <table class="table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th style="text-align: right;">ราคา(บาท)</th>
                        <th style="text-align: right;">จำนวน</th>
                        <th style="text-align: right;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    while ($rs_od = $db->get($query_od)) {
                        $total_price = $rs_od['price'] * $rs_od['quantity'];
                        $grand_total = $total_price + $grand_total;
                        ?>
                        <tr>
                            <td>
                                <img src="<?php echo base_url(); ?>/upload/product/sm_<?php echo $rs_od['image']; ?>">
                            </td>
                            <td><?php echo $rs_od['name']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($rs_od['price'], 2); ?></td>
                            <td style="text-align: right;"><?php echo $rs_od['quantity']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($total_price, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <tr class="info">
                        <td colspan="5" style="text-align: right;">
                            ราคารวมทั้งหมด <strong><?php echo number_format($grand_total, 2); ?></strong> บาท
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */
mysql_close();
