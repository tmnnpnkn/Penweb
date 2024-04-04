<?php
$thai_month_arr = array(
    "0" => "",
    "1" => "มกราคม",
    "2" => "กุมภาพันธ์",
    "3" => "มีนาคม",
    "4" => "เมษายน",
    "5" => "พฤษภาคม",
    "6" => "มิถุนายน",
    "7" => "กรกฎาคม",
    "8" => "สิงหาคม",
    "9" => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม"
);

function thai_date($time)
{
    global $thai_month_arr;

    if (!is_numeric($time)) {
        return "Invalid timestamp";
    }

    $thai_date_return = "";

    $thai_date_return .=  date("j", $time);
    $thai_date_return .= " ". $thai_month_arr[date("n", $time)];
    $thai_date_return .= " ". (date("Y", $time) + 543);
    // $thai_date_return .= " " . date("H:i", $time) . " น.";

    return $thai_date_return;
}
?>