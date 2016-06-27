<?php 

$url = 'http://scfh.ru/service_nsu/papers.php'; 
$ch = curl_init($url); 
//curl_setopt($ch, CURLOPT_POST, TRUE); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, 'id=1'); 
curl_setopt($ch, CURLOPT_URL, $url); 
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
//curl_setopt($ch, CURLOPT_HEADER, TRUE); 
curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
$json = curl_exec($ch); 
curl_close($ch);

$originalData = json_decode($json);

//echo json_encode($originalData); 

?>
<h2>Статьи для НГУ</h2>
<?
foreach($originalData as $key => $value)
{
	$paper = (array)$value;
	
	foreach($paper as $pk => $pv)	
	{
		$p = (array)$pv;
		
		echo "ID : ". $p["ID"]."<br/>";
		if (isset ($p["DETAIL_PICTURE"])) echo "<img width='500px' src='". $p["DETAIL_PICTURE"]."' /><br/>";
		echo "Название : <b>". $p["NAME"]."</b><br/>";
		echo "Публикация : ". $p["ACTIVE_FROM"]."<br/>";
		echo "Абстракт : <i>". $p["PREVIEW_TEXT"]."</i><br/>";		
		echo "Полный текст : ". $p["DETAIL_TEXT"]."<br/>";
		
		
		echo "<br/><br/>";	
	}
	
	

		
		

}

?>
<?

/* echo "<br/><br/>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br/><br/>"; */

$url = 'http://scfh.ru/service_nsu/materials.php'; 
$ch = curl_init($url); 
//curl_setopt($ch, CURLOPT_POST, TRUE); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, 'id=1'); 
curl_setopt($ch, CURLOPT_URL, $url); 
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
//curl_setopt($ch, CURLOPT_HEADER, TRUE); 
curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
$json = curl_exec($ch); 
curl_close($ch);

$originalData = json_decode($json);
?>
<h2>Материалы для НГУ</h2>
<?
foreach($originalData as $key => $value)
{
	$material = (array)$value;
	
	foreach($material as $mk => $mv)	
	{
		$m = (array)$mv;
		
		echo "ID : ". $m["ID"]."<br/>";
		if (isset ($m["DETAIL_PICTURE"])) echo "<img width='500px' src='". $m["DETAIL_PICTURE"]."' /><br/>";
		echo "Название : <b>". $m["NAME"]."</b><br/>";
		echo "Публикация : ". $m["ACTIVE_FROM"]."<br/>";
		echo "Тип : ". $m["PROPERTY_TYPE"]."<br/>";
		echo "Абстракт : <i>". $m["PREVIEW_TEXT"]."</i><br/>";		
		echo "Полный текст : ". $m["DETAIL_TEXT"]."<br/>";
		
		
		echo "<br/><br/>";	
	}
}
/* echo "<br/><br/>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br/><br/>"; */

$url = 'http://scfh.ru/service_nsu/journals.php'; 
$ch = curl_init($url); 
//curl_setopt($ch, CURLOPT_POST, TRUE); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, 'id=1'); 
curl_setopt($ch, CURLOPT_URL, $url); 
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
//curl_setopt($ch, CURLOPT_HEADER, TRUE); 
curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
$json = curl_exec($ch); 
curl_close($ch);

$originalData = json_decode($json);
?>
<h2>Журналы для НГУ</h2>
<?
foreach($originalData as $key => $value)
{
	$journal = (array)$value;
	
	foreach($journal as $jk => $jv)	
	{
		$j = (array)$jv;
		
		echo "ID : ". $j["ID"]."<br/>";
		if (isset ($j["DETAIL_PICTURE"])) echo "<img width='500px' src='". $j["DETAIL_PICTURE"]."' /><br/>";
		echo "Название : <b>". $j["NAME"]."</b><br/>";
		echo "Публикация : ". $j["ACTIVE_FROM"]."<br/>";
		
		
		echo "<br/><br/>";	
	}
}

/* echo "<br/><br/>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br/><br/>"; */

?>