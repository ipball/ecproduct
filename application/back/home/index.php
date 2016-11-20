<?php
/*
 * php code///////////**********************************************************
 */
$title = 'ระบบจัดการร้านค้า';
$db = new database();
$option_user = array(
    "table" => "users"
);
$query_user = $db->select($option_user);

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
            <h1 class="page-header">ยินดีต้อนรับ!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert">ยินดีต้อนรับสู่ระบบ ecProduct by itOffside.com</div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.search-button').click(function () {
                $('.search-form').toggle();
                return false;
            });
        });
    </script>
</div>

<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */