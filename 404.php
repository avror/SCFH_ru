<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

 CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y"); 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

?>

<section class="_margin-top _grid-section">
        <div class="grid-col">
            <div class="grid-item grid-item-col-4 faculty">

<?
$APPLICATION->SetTitle("404 Not Found");

echo "<center>";
echo "<br><br>";
echo "Что-то пошло не так. Страница не найдена.<br><br>Попробуйте воспользоваться поиском.";
echo "<br><br><br>";
echo "</center>";
?>
</div></div></section>
<?	
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
				
			

