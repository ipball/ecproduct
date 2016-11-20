<?php

function thaidate($strDate) {
    $strYear = date("Y", strtotime($strDate)+543);
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("d", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strMonthCut = Array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay/$strMonthThai/$strYear, $strHour:$strMinute";
}