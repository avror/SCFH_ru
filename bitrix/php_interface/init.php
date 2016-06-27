<? CModule::IncludeModule('fairytale.tpic');
//ко всем дублям в символных кодах добавляем внутренний ID

AddEventHandler("sale", "OnSalePayOrder", Array("Order", "OnSaleAfterPayOrder"));

class Order
{

    function OnSaleAfterPayOrder($id, $val)
    {
        if ($val == "Y") {
            if (CModule::IncludeModule("iblock")) {
                if (CModule::IncludeModule("sale")) {
                    $EVENT_ID = 46;//id события отправки письма
                    $EVENT_ID_EN = 56;//id события отправки письма EN

                    $IB_ID = 32;//IB для доступа к статьям
                    $IB_ID_EN = 70;//IB для доступа к статьям EN

                    $IB_PDF_EN = 65;//IB электронных версий журналов EN
                    $IB_PDF = 62;//IB электронных версий журналов

                    $INFO_BLOCK_ELECTRO = 66;//IB подписки на электронные версии
                    $INFO_BLOCK_ELECTRO_EN = 72;//IB подписки на электронные версии EN
                    $IB_LIST = 73;//IB списка на рассылку
                    $date = ConvertTimeStamp();

                    $count_half = 0;
                    $count_year = 0;
                    $PROPERTY_CODE = "USER";  // код свойства

                    $arOrder = CSaleOrder::GetByID($id);
                    $USER_ID = $arOrder['USER_ID']; //получаем данные о создателе заказа
                    $rsUser = CUser::GetByID($USER_ID);
                    $arUser = $rsUser->Fetch();
                    $EMAIL = $arUser["EMAIL"];

                    $Basket = CSaleBasket::GetList(Array("ID" => "ASC"), Array("ORDER_ID" => $arOrder["ID"]));

                    while ($result = $Basket->Fetch()) {
                        $ITEMS[] = $result;
                    }

                    foreach ($ITEMS as $item) {//для каждого товара заказа
                        $PRODUCT_ID = $item["PRODUCT_ID"];
                        if (!$date) {
                            $date = $item["DATE_UPDATE"];
                        }
                        $IB_Search = CIBlockElement::GetByID($PRODUCT_ID);
                        while ($res_1 = $IB_Search->Fetch()) {
                            $INFO_BLOCK = $res_1["IBLOCK_ID"];
                        }

                        if (($INFO_BLOCK == $INFO_BLOCK_ELECTRO) or ($INFO_BLOCK == $IB_PDF) or ($INFO_BLOCK == $IB_PDF_EN) or ($INFO_BLOCK == $INFO_BLOCK_ELECTRO_EN))
                        {//покупка - pdf подписки или просто журнала
                            if ($INFO_BLOCK == $IB_PDF) {
                                $INFO_BLOCK_ELECTRO = $IB_PDF;
                            }
                            if ($INFO_BLOCK == $IB_PDF_EN) {
                                $EVENT_ID = $EVENT_ID_EN;
                                $INFO_BLOCK_ELECTRO = $IB_PDF_EN;
                            }
                            if ($INFO_BLOCK == $INFO_BLOCK_ELECTRO_EN) {
                                $EVENT_ID = $EVENT_ID_EN;
                                $INFO_BLOCK_ELECTRO = $INFO_BLOCK_ELECTRO_EN;
                            }
                            $arSelect = Array("ID", "PROPERTY_HALFYEAR", "PROPERTY_YEAR", "PROPERTY_COUNT");
                            $arFilter = Array("IBLOCK_ID" => $INFO_BLOCK_ELECTRO, "ACTIVE" => "Y", "ID" => $PRODUCT_ID);
                            $res_2 = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                            while ($res = $res_2->Fetch()) {
                                $HALFYEAR = $res["PROPERTY_HALFYEAR_VALUE"];//полугодие подписки
                                $YEAR = $res["PROPERTY_YEAR_VALUE"];//год подписки
                                $Count = $res["PROPERTY_COUNT_VALUE"];
                            }

                            if ($YEAR) {//вариант 1, покупка уже вышедших номеров
                                $arSelect = Array("ID", "PROPERTY_PDF", "PROPERTY_HALFYEAR", "PROPERTY_YEAR");
                                //в фильтре выбираем только журанлы, подходящие по году
                                $arFilter = Array("IBLOCK_ID" => $IB_PDF, "ACTIVE" => "Y", "PROPERTY_YEAR_VALUE" => $YEAR);//приобретение подписки(РУ)
                                if ($INFO_BLOCK_ELECTRO == $IB_PDF) {
                                    $arFilter = Array("IBLOCK_ID" => $IB_PDF, "ACTIVE" => "Y", "ID" => $PRODUCT_ID);//приобретение журнала(РУ)
                                }
                                if ($INFO_BLOCK_ELECTRO == $IB_PDF_EN) {
                                    $arFilter = Array("IBLOCK_ID" => $IB_PDF_EN, "ACTIVE" => "Y", "ID" => $PRODUCT_ID);//приобретение журнала(EN)
                                }
                                if ($INFO_BLOCK_ELECTRO == $INFO_BLOCK_ELECTRO_EN) {
                                    $arFilter = Array("IBLOCK_ID" => $IB_PDF_EN, "ACTIVE" => "Y", "PROPERTY_YEAR_VALUE" => $YEAR);//приобретение подписки(EN)
                                }
                                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                                while ($r = $res->Fetch()) {
                                    $Magazins[] = $r;
                                }

                                foreach ($Magazins as $key => $magazin) {
                                    if ($HALFYEAR) {
                                        $count_half = $count_half + 1;
                                        if ($HALFYEAR == $magazin["PROPERTY_HALFYEAR_VALUE"]) {
                                            $arFile = CFile::GetFileArray($magazin["PROPERTY_PDF_VALUE"]);
                                            $PDF_URL = $arFile["SRC"];
                                            $arEventFields = array(
                                                "PRODUCT_NAME" => "Ссылка на pdf - файл",
                                                "PRODUCT_ID" => $PRODUCT_ID,
                                                "LINK_DOWNLOAD" => $PDF_URL,
                                                "ORDER_ID" => $id,
                                                "ORDER_DATE" => $date,
                                                "EMAIL" => $EMAIL,
                                            );
                                            CEvent::SendImmediate("ISALE_ELECTRO_SEND", s1, $arEventFields, "N", $EVENT_ID);
                                        } else {
                                            $count_half = $count_half - 1;
                                        }
                                    } else {
                                        $count_year = $count_year + 1;
                                        $arFile = CFile::GetFileArray($magazin["PROPERTY_PDF_VALUE"]);
                                        $PDF_URL = $arFile["SRC"];
                                        $arEventFields = array(
                                            "PRODUCT_NAME" => "Ссылка на pdf - файл",
                                            "PRODUCT_ID" => $PRODUCT_ID,
                                            "LINK_DOWNLOAD" => $PDF_URL,
                                            "ORDER_ID" => $id,
                                            "ORDER_DATE" => $date,
                                            "EMAIL" => $EMAIL,
                                        );
                                        CEvent::SendImmediate("ISALE_ELECTRO_SEND", s1, $arEventFields, "N", $EVENT_ID);
                                    }
                                }
                                $Count = $Count - ($count_year + $count_half);
                            } else {

                            }
                            if ($Count > 0) {//заказ будущих номеров, добавление в список
                                $el = new CIBlockElement;
                                $PROP = array();
                                $PROP[312] = $Count;

                                $arLoadProductArray = Array(
                                    "MODIFIED_BY" => 1, // элемент изменен админом
                                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                                    "IBLOCK_ID" => $IB_LIST,
                                    "PROPERTY_VALUES" => $PROP,
                                    "NAME" => $USER_ID,
                                    "ACTIVE" => "Y",            // активен
                                    "PREVIEW_TEXT" => "",
                                    "DETAIL_TEXT" => "",
                                    "DETAIL_PICTURE" => ""
                                );
                                if ($PRODUCT_ID = $el->Add($arLoadProductArray))
                                    $ans = "New ID: " . $PRODUCT_ID;
                                else
                                    $ans = "Error: " . $el->LAST_ERROR;
                            }
                        }
                        if (($INFO_BLOCK == $IB_ID) or ($INFO_BLOCK == $IB_ID_EN)) {//подписка
                            $ID_s = array();
                            if ($INFO_BLOCK == $IB_ID_EN) {
                                $IB_ID = $IB_ID_EN;
                            }
                            $arSelect = Array("ID", "PROPERTY_USER", "PROPERTY_TYPE", "PROPERTY_VARIANT");
                            $arFilter = Array("IBLOCK_ID" => $IB_ID, "ACTIVE" => "Y", "PROPERTY_TYPE" => $PRODUCT_ID, "PROPERTY_VARIANT_VALUE" => "PAPER");
                            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                            while ($r = $res->Fetch()) {
                                $subs[] = $r;
                            }

                            foreach ($subs as $sub) {
                                $ID_s[] = $sub["PROPERTY_USER_VALUE"];
                                $ID_update = $sub["ID"];
                            }
                            $ID_s[] = $USER_ID;
                            CIBlockElement::SetPropertyValuesEx($ID_update, $IB_ID, array($PROPERTY_CODE => $ID_s));
                        }
                        if (($INFO_BLOCK == 49) or ($INFO_BLOCK == 59)) {//подписка
                            $ID_s = array();
                            if ($INFO_BLOCK == 59) {
                                $IB_ID = 70;
                            }
                            $arSelect = Array("ID", "PROPERTY_USER", "PROPERTY_TYPE", "PROPERTY_VARIANT");
                            $arFilter = Array("IBLOCK_ID" => $IB_ID, "ACTIVE" => "Y", "PROPERTY_TYPE" => $PRODUCT_ID, "PROPERTY_VARIANT_VALUE" => "PAPER");
                            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                            while ($r = $res->Fetch()) {
                                $subs[] = $r;
                            }
                            foreach ($subs as $sub) {
                                $ID_s[] = $sub["PROPERTY_USER_VALUE"];
                                $ID_update = $sub["ID"];
                            }
                            $ID_s[] = $USER_ID;
                            CIBlockElement::SetPropertyValuesEx($ID_update, $IB_ID, array($PROPERTY_CODE => $ID_s));
                        }
                    }

                }
            }
        }
    }

}

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("CymCode", "OnBeforeIBlockElementAddHandler"));

class CymCode
{

// создаем обработчик события "OnBeforeIBlockElementAdd" 
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        global $APPLICATION;

        $currentCode = $arFields["CODE"];

        $cnt = CIBlockElement::GetList(
            array(),
            array('CODE' => $currentCode),
            array(),
            false,
            array('ID')
        );

        //если уже где-то есть дубль в системе, то стыкуем инфоблок + дату
        if ($cnt > 0) {
            //для глав книг добавляем еще время
            if ($arFields["IBLOCK_ID"] == 24 || $arFields["IBLOCK_ID"] == 38)
                $d = date('dYmHm');
            else $d = date('dYm');

            $arFields["CODE"] = $currentCode . "-" . $arFields["IBLOCK_ID"] . $d;
        }

        //$APPLICATION->throwException($arFields["CODE"]);


        return;
    }
}

/* //модифицируем поисковый индекс, чтобы включал в себя и авторов статей
// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
 // создаем обработчик события "BeforeIndex"
function BeforeIndexHandler($arFields)
{
   if(!CModule::IncludeModule("iblock")) // подключаем модуль
      return $arFields;
    if($arFields["MODULE_ID"] == "iblock")
   {
      $db_props = CIBlockElement::GetProperty(                        // Запросим свойства индексируемого элемента
                                    $arFields["17"],         // BLOCK_ID индексируемого свойства
                                    $arFields["36"],          // ID индексируемого свойства
                                    array("sort" => "asc"),       // Сортировка (можно упустить)
                                    Array("CODE"=>"PERSON")); // CODE свойства (в данном случае артикул)
      if($ar_props = $db_props->Fetch())
         $arFields["TITLE"] .= " ".$ar_props["VALUE"];   // Добавим свойство в конец заголовка индексируемого элемента
   }
   
   return $arFields; // вернём изменения 
} */

//копирование журнала в инфоблоки для печатной продажи - ГОТОВО для журналов 
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("CopyPrintClass", "OnAfterIBlockElementAddHandler"));

class CopyPrintClass
{
    // создаем обработчик события "OnAfterIBlockElementAdd"
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        //если прошло успешное добавление
        if ($arFields["ID"] > 0) {
            $iblock = $arFields["IBLOCK_ID"];
            if ($iblock == 62) //электронный журнал (РУ, основной)
            {
                $IB_LIST = 73;//IB списка на рассылку
                $date = ConvertTimeStamp();

                $arSelect = Array("ID", "NAME", "PROPERTY_COUNT");
                $arFilter = Array("IBLOCK_ID" => $IB_LIST, "ACTIVE" => "Y");
                $result = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while ($r = $result->Fetch()) {
                    $List[] = $r;
                }
                foreach ($List as $key => $item_list) {
                    $PRODUCT_ID = $item_list["ID"];  // изменяем элемент с кодом (ID)
                    $Count = $item_list["PROPERTY_COUNT_VALUE"];
                    $rsUser = CUser::GetByID($item_list["NAME"]);
                    $arUser = $rsUser->Fetch();
                    $EMAIL = $arUser["EMAIL"];
                    $arSelect = Array("ID", "PROPERTY_PDF", "PROPERTY_HALFYEAR", "PROPERTY_YEAR");
                    //в фильтре выбираем переданный журнал
                    $arFilter = Array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y", "ID" => $arFields["ID"]);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                    while ($r = $res->Fetch()) {
                        $Magazins = $r;
                    }
                    if ($Magazins["PROPERTY_PDF_VALUE"]) {
                        $arFile = CFile::GetFileArray($Magazins["PROPERTY_PDF_VALUE"]);
                        $PDF_URL = $arFile["SRC"];
                        $arEventFields = array(
                            "PRODUCT_NAME" => "Ссылка на pdf - файл",
                            "PRODUCT_ID" => $arFields["ID"],
                            "LINK_DOWNLOAD" => $PDF_URL,
                            "ORDER_ID" => "",
                            "ORDER_DATE" => $date,
                            "EMAIL" => $EMAIL,
                        );
                        CEvent::SendImmediate("ISALE_ELECTRO_SEND", s1, $arEventFields, "N", 46);
                        $el = new CIBlockElement;//update
                        $PROP = array();
                        $PROP[312] = $Count - 1;//понижаем значение кол-ва номеров
                        $arLoadProductArray = Array(
                            "MODIFIED_BY" => 1, // элемент изменен админом
                            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                            "IBLOCK_ID" => $IB_LIST,
                            "PROPERTY_VALUES" => $PROP,
                            "NAME" => $item_list["NAME"],
                            "ACTIVE" => "Y",            // активен
                            "PREVIEW_TEXT" => "",
                            "DETAIL_TEXT" => "",
                            "DETAIL_PICTURE" => ""
                        );

                        $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
                        if ($Count == 1) {
                            $del = $el->Delete($PRODUCT_ID);
                        }
                    }
                }
            }

            if ($iblock == 23 || $iblock == 33) {
                global $USER;

                //AddMessage2Log($arFields,"copyprint");
                $el = new CIBlockElement;

                $PROP = array();

                $code = $arFields["CODE"];
                $originalElementID = $arFields["ID"];

                if ($iblock == 23) //электронный журнал (РУ)
                {
                    //$date = split(".", $arFields["ACTIVE_FROM"]);
                    $name = $arFields["NAME"] . ", Том " . $arFields["PROPERTY_VALUES"]["59"]["n0"]["VALUE"] . ", №" . $arFields["PROPERTY_VALUES"]["55"]["n0"]["VALUE"] . ", " . date("Y") . " год";
                    $targetBlock = 53;
                    $PROP["225"] = $originalElementID;
                    //$preview_picture =  $arFields["PREVIEW_PICTURE"];
                }

                if ($iblock == 33) //электронный журнал (EN)
                {
                    //$date = split(".", $arFields["ACTIVE_FROM"]);
                    $name = $arFields["NAME"] . ", Vol." . $arFields["PROPERTY_VALUES"]["124"]["n0"]["VALUE"] . ", N" . $arFields["PROPERTY_VALUES"]["120"]["n0"]["VALUE"] . ", " . date("Y") . " year";
                    $targetBlock = 55;
                    $PROP["242"] = $originalElementID;
                    //$preview_picture =  $arFields["PREVIEW_PICTURE"];
                }


                /* 			else if($iblock == 16) //книга
                            {
                                $name = $arFields["NAME"];
                                $targetBlock = 53;
                                $PROP[] = $originalElementID;
                            } */

                $arLoadProductArray = Array(
                    "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                    "IBLOCK_ID" => $targetBlock,
                    "CODE" => $code,
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $name,
                    "ACTIVE" => $arFields["ACTIVE"],            // активен
                    "ACTIVE_FROM" => $arFields["ACTIVE_FROM"],
                    "PREVIEW_TEXT" => "",
                    "DETAIL_TEXT" => "",
                    //"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
                    //"PREVIEW_PICTURE" => $preview_picture,
                    /*"DETAIL_PICTURE" => $arFields["DETAIL_PICTURE"], */
                );

                if ($PRODUCT_ID = $el->Add($arLoadProductArray)){
//                    AddMessage2Log($PRODUCT_ID, "copyprint");
                }
//                else
//                    AddMessage2Log($el->LAST_ERROR, "copyprint");
            }
        }
    }
}

//обновление печатного журнала, если обновляется электронный элемент - ГОТОВО для журналов
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("UpdatePrintClass", "OnAfterIBlockElementUpdateHandler"));

class UpdatePrintClass
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["ID"] > 0) {
            $iblock = $arFields["IBLOCK_ID"];

            if ($iblock == 23 || $iblock == 33) {
                global $USER;

                //AddMessage2Log($arFields,"updateprint");

                $originalId = $arFields["ID"];

                if ($iblock == 23) {
                    $targetBlock = 53;
                }

                if ($iblock == 33) {
                    $targetBlock = 55;
                }

                //получаем номер печатного варианта по оригинальному номеру
                $arSort = array("SORT" => "ASC", "DATE_ACTIVE_FROM" => "DESC", "ID" => "DESC");
                $arFilter = array("IBLOCK_ID" => $targetBlock, "PROPERTY_JOURNAL" => $originalId);
                $arSelect = array("ID", "IBLOCK_ID");

                $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);

                while ($obElement = $rsElement->GetNextElement()) {
                    $arElement = $obElement->GetFields();
                    $resUpdateID = $arElement["ID"];
                }

                //AddMessage2Log($arFields);
                /* 			if ($resUpdateID != null)
                            { */
                //обновляем печатный номер НАЧАЛО

                $el = new CIBlockElement;

                $year = explode('.', $arFields['ACTIVE_FROM'])[2];

                if ($iblock == 23) //электронный журнал
                {
                    //$date = split(".", $arFields["ACTIVE_FROM"]);
                    //AddMessage2Log($arFields["PROPERTY_VALUES"]["59"][$originalId.":59"]['VALUE']);
                    //AddMessage2Log($arFields["PROPERTY_VALUES"]["55"][$originalId.":55"]['VALUE']);
                    $name = $arFields["NAME"] . ", Том " . $arFields["PROPERTY_VALUES"]["59"][$originalId . ":59"]['VALUE'] . ", №" . $arFields["PROPERTY_VALUES"]["55"][$originalId . ":55"]['VALUE'] . ", " . $year . " год";
                    //$preview_picture =  $arFields["PREVIEW_PICTURE"];
                }

                if ($iblock == 33) //электронный журнал (EN)
                {
                    //$date = split(".", $arFields["ACTIVE_FROM"]);
                    $name = $arFields["NAME"] . ", Vol." . $arFields["PROPERTY_VALUES"]["59"][$originalId . ":59"]['VALUE'] . ", N" . $arFields["PROPERTY_VALUES"]["55"][$originalId . ":55"]['VALUE'] . ", " . $year . " year";
                    //$preview_picture =  $arFields["PREVIEW_PICTURE"];
                }

                $arLoadProductArray = Array(
                    "ACTIVE" => $arFields["ACTIVE"],
                    "ACTIVE_FROM" => $arFields["ACTIVE_FROM"],
                    "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
                    "NAME" => $name,
                    "PREVIEW_PICTURE" => $preview_picture,
                    /*   				"PROPERTY_VALUES"=> $PROP, */
                );

                $res = $el->Update($resUpdateID, $arLoadProductArray);

                //обновляем печатный номер КОНЕЦ
                //
            }
        }

        /*         if($arFields["RESULT"])
                    AddMessage2Log("Запись с кодом ".$arFields["ID"]." изменена.");
                else
                    AddMessage2Log("Ошибка изменения записи ".$arFields["ID"]." (".$arFields["RESULT_MESSAGE"].")."); */
    }
}

//удалениие печатной статьи или книги из-за удаления электронного варианта - ГОТОВО для журналов
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("RemovePrintClass", "OnBeforeIBlockElementDeleteHandler"));

class RemovePrintClass
{
    // создаем обработчик события "OnAfterIBlockElementDelete"
    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        if ($ID > 0) {
            //получаем инфу, что за элемент

            $arSort = array("SORT" => "ASC", "DATE_ACTIVE_FROM" => "DESC", "ID" => "DESC");
            $arFilter = array("ID" => $ID);
            $arSelect = array("ID", "IBLOCK_ID");

            $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

            while ($obElement = $rsElement->GetNextElement()) {
                $arElement = $obElement->GetFields();
                $origDel = $arElement["ID"];
                $iblock = $arElement["IBLOCK_ID"];
            }

            if ($iblock == 23 || $iblock == 33 || $iblock == 16) {
//                AddMessage2Log($ID, "!!!!before remove");

                //AddMessage2Log($arFields,"removeprint");

                $originalId = $origDel;

                if ($iblock == 23) {
                    $targetBlock = 53;
                    $arFilter = array("IBLOCK_ID" => $targetBlock, "PROPERTY_JOURNAL" => $originalId);
                }

                if ($iblock == 33) {
                    $targetBlock = 55;
                    $arFilter = array("IBLOCK_ID" => $targetBlock, "PROPERTY_JOURNAL" => $originalId);
                }

                if ($iblock == 16) {
                    $targetBlock = 60;
                    $arFilter = array("IBLOCK_ID" => $targetBlock, "PROPERTY_BOOK" => $originalId);
                }

                /* 				AddMessage2Log($originalId,"!!!!removeprint"); */
                /* 				AddMessage2Log($targetBlock,"!!!!removeprint"); */

                //получаем номер печатного варианта по оригинальному номеру
                $arSort = array("SORT" => "ASC", "DATE_ACTIVE_FROM" => "DESC", "ID" => "DESC");
                $arSelect = array("ID", "IBLOCK_ID");

                $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                while ($obElement = $rsElement->GetNextElement()) {
                    $arElement = $obElement->GetFields();
                    $resDel = $arElement["ID"];

                    /* 					AddMessage2Log($arElement,"!!!!element"); */
                }


                //AddMessage2Log($resDel,"!!!!removeprint");


                //удаляем
                if (($iblock == 23 || $iblock == 33 || $iblock == 16) && $resDel > 0) //удаляем
                {
                    if (CIBlock::GetPermission($targetBlock) >= 'W') {
                        global $DB;

                        $DB->StartTransaction();
                        if (!CIBlockElement::Delete($resDel)) {
                            $strWarning .= 'Error!';
                            $DB->Rollback();
                        } else
                            $DB->Commit();
                    }
                }
            }

            /* 			return false; */
        }
    }
}

///////////////////////////////////// Создание товара - печатной книги из электронной для РУ сайта //////////////////////////

////// проверка на бот

function isBot($log = false)
{
    $bot = 'NO';

    // Яндекс и Гугл
    if (stristr($_SERVER['HTTP_USER_AGENT'], 'Yandex')) {
        $bot = 'Yandex';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'YandexBot')) {
        $bot = 'YandexBot';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Yandex')) {
        $bot = 'Yandex';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'YandexDirect')) {
        $bot = 'Yandex Direct';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {
        $bot = 'Googlebot';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Google')) {
        $bot = 'Google';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Mediapartners-Google')) {
        $bot = 'Mediapartners-Google (Adsense)';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'BitrixCloud')) {
        $bot = 'BitrixCloud';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'bingbot')) {
        $bot = 'Bing';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'BegunAdvertising')) {
        $bot = 'BegunAdvertising';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'yahoo')) {
        $bot = 'Yahoo';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'crawler')) {
        $bot = 'Crawler';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'ltx71')) {
        $bot = 'ltx71';
    } else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Bot')) {
        $bot = 'Unknown';
    }


    //добавляем контент-менеджера или администратора как бот :)

    global $USER;

    $arGroupAvalaible = array(6, 13);
    $arGroups = CUser::GetUserGroup($USER->GetID());
    $result_intersect = array_intersect($arGroupAvalaible, $arGroups);

    if ($USER->IsAdmin() || !empty($result_intersect))
        $bot = 'SITEMANAGER';

    //echo "BOT:".$bot;
    //echo $_SERVER['HTTP_USER_AGENT'];

    if ($bot != 'NO') {
        // пишем бота
        if ($log) {
//            $log_file = $_SERVER["DOCUMENT_ROOT"] . "/b_log.txt";
//            file_put_contents($log_file, date("d.m.Y H:i:s") . "; " . $bot . " - " . $_SERVER['HTTP_USER_AGENT'] . "; " . $_SERVER['REQUEST_URI'] . "\r\n", FILE_APPEND | LOCK_EX);
        }
        return true;
    }
    if ($log) {
        if (SITE_ID == 's1') $log_file = $_SERVER["DOCUMENT_ROOT"] . "/a_log_ru.txt";
//        else $log_file = $_SERVER["DOCUMENT_ROOT"] . "/a_log_en.txt";
//        file_put_contents($log_file, date("d.m.Y H:i:s") . "; " . $_SERVER['HTTP_USER_AGENT'] . "; " . $_SERVER['REQUEST_URI'] . "\r\n", FILE_APPEND | LOCK_EX);
    }

    //echo $_SERVER['HTTP_USER_AGENT'];

    return false;
}


//создание печатной книги из электронной (РУ)
// 16 - эл, 60 - п
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("CopyBookClass", "OnAfterIBlockElementAddHandler"));

class CopyBookClass
{
    // создаем обработчик события "OnAfterIBlockElementAdd"
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        //если прошло успешное добавление
        if ($arFields["ID"] > 0) {
            $iblock = $arFields["IBLOCK_ID"];

            if ($iblock == 16) {
                global $USER;

                $el = new CIBlockElement;

                $PROP = array();

                $code = $arFields["CODE"];
                $originalElementID = $arFields["ID"];
                $targetBlock = 60;

                $name = $arFields["NAME"];
                $PROP["280"] = $originalElementID;

                $arLoadProductArray = Array(
                    "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                    "IBLOCK_ID" => $targetBlock,
                    "CODE" => $code,
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $name,
                    "ACTIVE" => $arFields["ACTIVE"],            // активен
                    "ACTIVE_FROM" => $arFields["ACTIVE_FROM"],            // активен
                    "PREVIEW_TEXT" => "",
                    "DETAIL_TEXT" => "",
                );

                if ($PRODUCT_ID = $el->Add($arLoadProductArray)){

                }
//                    AddMessage2Log($PRODUCT_ID, "copybook");
//                else
//                    AddMessage2Log($el->LAST_ERROR, "copybook");

            }
        }
    }
}


//обновление печатной книги из электронной (РУ)
// 16 - эл, 60 - п
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("UpdateBookClass", "OnAfterIBlockElementUpdateHandler"));

class UpdateBookClass
{
    // создаем обработчик события "OnAfterIBlockElementAdd"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        //если прошло успешное добавление
        if ($arFields["ID"] > 0) {
            $iblock = $arFields["IBLOCK_ID"];

            if ($iblock == 16) {
                global $USER;

                $originalId = $arFields["ID"];
                $targetBlock = 60;
                $name = $arFields["NAME"];

                //получаем печатный вариант по оригинальному номеру
                $arSort = array("SORT" => "ASC", "DATE_ACTIVE_FROM" => "DESC", "ID" => "DESC");
                $arFilter = array("IBLOCK_ID" => $targetBlock, "PROPERTY_BOOK" => $originalId);
                $arSelect = array("ID", "IBLOCK_ID");

                $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);

                while ($obElement = $rsElement->GetNextElement()) {
                    $arElement = $obElement->GetFields();
                    $resUpdateID = $arElement["ID"];
                }

                $el = new CIBlockElement;

                $arLoadProductArray = Array(
                    "ACTIVE" => $arFields["ACTIVE"],
                    "ACTIVE_FROM" => $arFields["ACTIVE_FROM"],
                    "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
                    "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
                    "NAME" => $name,
// 							"PREVIEW_PICTURE" => $preview_picture,
                );

                $res = $el->Update($resUpdateID, $arLoadProductArray);
            }
        }
    }
}

?>
