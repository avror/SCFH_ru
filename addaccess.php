<?

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if (CModule::IncludeModule('sale'))
{
	echo "jopa";
$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), array('ID'=>46, 'PAYED'=> "Y", 'BASKET_PRODUCT_ID' => 4365));

		while ($res = $rsOrder->Fetch())
		{
 			$tradeResult1[] = $res;
		}

 	echo "<pre>";
	print_r($tradeResult1[0]);
	echo "</pre>";
}
/*  if (CModule::IncludeModule("iblock"))
	{
$el = new CIBlockElement;

$PROP = array();
$PROP[220] = 14;  //пользователь

$date = date("d.m.Y");

//echo $date;
	
//$PROP[218] = $date;   //начало подписки - текущая дата

$lastday=date("d.") . (date("m")+1) . date(".Y");  //(здесь + месяц)
	
//echo $lastday;

//$PROP[219] = $lastday;    //окончание подписки

$arLoadProductArray = Array(
  "MODIFIED_BY"    => 14, // элемент изменен пользовтаелем, который купил подписку
  "IBLOCK_SECTION_ID" => 75,         
  "IBLOCK_ID"      => 32,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => "Подписка на 1 месяц",
  "DATE_ACTIVE_FROM" => $date,
  "DATE_ACTIVE_TO" => $lastday,
  "ACTIVE"         => "Y",            // активен
  );

if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "New ID: ".$PRODUCT_ID;
else
  echo "Error: ".$el->LAST_ERROR;
}  */
?>

<?

/* if (CModule::IncludeModule("iblock"))
{
	// проверяем есть ли у конкретного пользователя активная подписка в настоящий момент
	
	$subscriber = "false";
	
	$arSelect = Array("ID", "DATE_ACTIVE_TO"); 
	
	$arFilter = Array("IBLOCK_ID" => 32, "ACTIVE" => "Y", ">DATE_ACTIVE_TO" => date("d.m.Y"), "PROPERTY_USER" => 14);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

	while ($r = $res->Fetch())
	{
 		$subs[] = $r;
	}
	
/* 	echo "<pre>";
	print_r($subs);
	echo "</pre>"; 
	
	if (count($subs)) $subscriber = "true";
	
	echo $subscriber;
} */

?>