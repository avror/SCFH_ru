<?
ob_start(); //стартуем буферизацию
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
ob_end_clean(); //очищаем буфер
ob_end_flush(); //закрываем его
//Далее код использующий функционал Битрикс

global $USER;

if (!is_object($USER)) $USER = new CUser;

if ($USER->IsAdmin()) echo "Данные для НГУ";

?>