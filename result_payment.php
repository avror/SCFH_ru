<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment.receive",
    "",
    Array(
//                            "PAY_SYSTEM_ID" => "1",
//                            "PERSON_TYPE_ID" => "3"
    )
);
?>