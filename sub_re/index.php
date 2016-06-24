<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "подписка");
$APPLICATION->SetPageProperty("keywords", "подписка");
$APPLICATION->SetPageProperty("title", "Подписка | Наука из первых рук");
$APPLICATION->SetTitle("Подписка | Наука из первых рук");

IncludeTemplateLangFile(__FILE__);
//$USER->Authorize(493);
if ($USER->IsAdmin()) {
//    echo "<pre>";
//    print_r($_GET["formresult"]);
//    echo "</pre>";
}
?>
    <section class="_margin-top _grid-section _margin-bottom">
        <div class="grid-col">
            <div class="grid-item grid-item-col-3 site-info _margin-top">
                <div id="tabs">
                    <ul class="_395">
                        <li class="fiz_lic">
                            <div class="div_lic">
                                <a href="#tabs-2">Подписка для физических лиц</a>
                            </div>
                        </li>
                        <li class="your_lic">
                            <div class="div_">
                                <a href="#tabs-1">Подписка для юридических лиц</a>
                            </div>
                        </li>
                    </ul>
                    <?
                    $PRICE_TYPE_ID = 1;
                    $arSelect1 = Array("NAME", "ID");
                    $arFilter1 = Array("IBLOCK_ID" => 71, "ACTIVE" => "Y");
                    $res1 = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter1, false, false, $arSelect1);
                    ?>
                    <div id="tabs-1">
                        <div class="icon1">
                            <i class="icon icon_ purch-sprite-subs_print"></i>
                        </div>
                        <?
                        if ($_GET["formresult"] == "addok"){
                        }
                        else{
                            ?>
                            <div class="flags">
                                <select name="subtriggerion" onchange="Write('На 6 номеров (годовая подписка на 2016 г.) - 1 500 руб.')" class="select yourid" size="1"
                                        style="height: 40px;width: 343px;margin-bottom: 15px;">
                                    <? while ($ob = $res1->GetNextElement()) {
                                        $arFields = $ob->GetFields();
                                        $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $arFields["ID"]));
                                        if ($arPrice = $rsPrices->Fetch()) {
                                            $PRICE_ = (int)$arPrice["PRICE"];
                                            ?>
                                            <option id="<?=$PRICE_?>" value="<?= $arFields["ID"] ?>" selected=""><?= $arFields["NAME"] ?>
                                                - <?= CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]); ?>
                                            </option>
                                        <? }
                                    } ?>
                                </select>
                                <!--                            <div class="var_1">На 3 номера (1-е полугодие 2016 г.) - 750 руб.</div>-->
                                <!--                            <div class="img">-->
                                <!--                                <img src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">-->
                                <!--                            </div>-->
                                <!--                            <div class="var_1">На 3 номера (2-е полугодие 2016 г.) - 750 руб.</div>-->
                                <!--                            <div class="img">-->
                                <!--                                <img src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">-->
                                <!--                            </div>-->
                                <!--                            <div class="var_1">На 6 номеров (годовая подписка на 2016 г.) - 1500 руб.</div>-->
                                <!--                            <div class="img">-->
                                <!--                                <img src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">-->
                                <!--                            </div>-->
                            </div>
                        <?
                        }
                        ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:form.result.new",
                            "",
                            Array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "WEB_FORM_ID" => "2",
                                "IGNORE_CUSTOM_TEMPLATE" => "N",
                                "USE_EXTENDED_ERRORS" => "Y",
                                "SEF_MODE" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "LIST_URL" => "",
                                "EDIT_URL" => "",
                                "SUCCESS_URL" => "",
                                "CHAIN_ITEM_TEXT" => "",
                                "CHAIN_ITEM_LINK" => "",
                                "VARIABLE_ALIASES" => Array(
                                    "WEB_FORM_ID" => "WEB_FORM_ID",
                                    "RESULT_ID" => "RESULT_ID"
                                )
                            )
                        ); ?>
                        <div class="desc_ your_desc_">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default", array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/your_desc.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                                false
                            );
                            ?>
                        </div>
                    </div>
                    <div id="tabs-2" class="tabs-2 more_">
                        <div class="electro">
                            <?
                            $PRICE_TYPE_ID = 1;
                            $arSelect = Array("NAME", "ID");
                            $arFilter = Array("IBLOCK_ID" => 49, "ACTIVE" => "Y");
                            $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
                            ?>
                            <div style="padding-left: 11px;">
                                <form method="POST" id="buySub">
                                    <input type="hidden" id="buySub" name="buySub" value="buySub"/>

                                    <div class="_margin-top purchase-buttons ">
                                        <ul class="purchase-link-list">
                                            <li style="height: 182px;">
                                                <a href="/sub_re/electro/" name="ae">
                                                    <img class="subt"
                                                         src="/files/medialibrary/26d/26dae36a7b0b8d9415b947760d85a706.png">

                                                    <div class="sub">Подписка на электронную версию (PDF)</div>
                                                </a>

                                                <div class="subscription">
                                                    <span
                                                        class="desc electro_payment">Только для электронных платежей!</span>

                                                    <div class="var_1">На 3 номера - 270 руб.</div>
                                                    <div class="img">
                                                        <img
                                                            src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                                    </div>
                                                    <div class="var_1">На 6 номеров - 540 руб.</div>
                                                    <div class="img">
                                                        <img
                                                            src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                                    </div>
                                                    <span class="desc">
                                                        <? $APPLICATION->IncludeComponent(
                                                            "bitrix:main.include",
                                                            ".default", array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "include/electro_desc.php",
                                                            "EDIT_TEMPLATE" => ""
                                                        ),
                                                            false
                                                        );
                                                        ?>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <a class="new_target" href="/new_subscribe_/">Подписка для юридических лиц</a>

                        </div>
                        <div class="print">
                            <?
                            $PRICE_TYPE_ID = 1;
                            $arSelect = Array("NAME", "ID");
                            $arFilter = Array("IBLOCK_ID" => IBLOCK_SUBS_PRINT_ID, "ACTIVE" => "Y");
                            $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
                            ?>
                            <div style="padding-left: 11px;">
                                <form method="POST" id="buySub">
                                    <input type="hidden" id="buySub" name="buySub" value="buySub"/>

                                    <div class="_margin-top purchase-buttons ">
                                        <ul class="purchase-link-list">
                                            <li style="height: 182px;">
                                                <a href="/sub_re/print/" name="ae">
                                                    <i class="purch-sprite purch-sprite-subs_print"></i>

                                                    <div class="sub">Подписка на печатную версию</div>
                                                </a>

                                                <div class="subscription">
                                                    <span class="desc electro_payment">&nbsp;</span>

                                                    <div class="var_1">На 3 номера - 750 руб.</div>
                                                    <div class="img"><img
                                                            src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                                    </div>
                                                    <div class="var_1">На 6 номеров - 1500 руб.</div>
                                                    <div class="img">
                                                        <img
                                                            src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                                    </div>
                                                    <?
                                                    //                                                    while ($ob = $res->GetNextElement()) {
                                                    //                                                        $arFields = $ob->GetFields();
                                                    //                                                        $Quant = 3;
                                                    //                                                        $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $arFields["ID"]));//, 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));
                                                    //                                                        if ($arPrice = $rsPrices->Fetch()) {
                                                    //                                                            $PRICE_ = (int)$arPrice["PRICE"];
                                                    //                                                            if (($arFields["ID"] != '73806') and ($arFields["ID"] != '73807') and ($arFields["ID"] != '4830')) {
                                                    //                                                                ?>
                                                    <!--                                                                <div class="var_1"-->
                                                    <!--                                                                     id="-->
                                                    <? //= $arFields["ID"] ?><!--">-->
                                                    <? //= $arFields["NAME"] ?><!--</div>-->
                                                    <!--                                                                <!--                                                                     onclick="Ajax_(-->
                                                    <!--                                                                --><? ////= $arFields["ID"] ?>
                                                    <!--                                                                <!--                                                                , -->
                                                    <!--                                                                --><? ////=$PRICE_?>
                                                    <!--                                                                <!--                                                                ,'-->
                                                    <!--                                                                --><? ////= $arFields["NAME"]?>
                                                    <!--                                                                <!--                                                                ', '')"-->
                                                    <!--                                                                <div class="img"><img-->
                                                    <!--                                                                        src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">-->
                                                    <!--                                                                </div>-->
                                                    <!--                                                                --><? //
                                                    //                                                            }
                                                    //                                                            ?>
                                                    <!--                                                            --><? //
                                                    //                                                        }
                                                    //                                                    }
                                                    ?>
                                                    <span class="desc">
                                                        <? $APPLICATION->IncludeComponent(
                                                            "bitrix:main.include",
                                                            ".default", array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "PATH" => SITE_DIR . "include/print_desc.php",
                                                            "EDIT_TEMPLATE" => ""
                                                        ),
                                                            false
                                                        );
                                                        ?>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="way_2">
                            <div class="no">
                                <br/><br/>

                                <h2>Способ 2: оставьте заявку на подписку и наш менеджер вышлет Вам форму для оплаты
                                    непосредственно в Банке</h2>
                                <? //endif;?>


                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:form.result.new",
                                    "",
                                    Array(
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "WEB_FORM_ID" => "1",
                                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                                        "USE_EXTENDED_ERRORS" => "Y",
                                        "SEF_MODE" => "N",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "3600",
                                        "LIST_URL" => "",
                                        "EDIT_URL" => "",
                                        "SUCCESS_URL" => "",
                                        "CHAIN_ITEM_TEXT" => "",
                                        "CHAIN_ITEM_LINK" => "",
                                        "VARIABLE_ALIASES" => Array(
                                            "WEB_FORM_ID" => "WEB_FORM_ID",
                                            "RESULT_ID" => "RESULT_ID"
                                        )
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?
                //if ($USER->IsAdmin()):
                ?>
            </div>
        </div>

        <div class="grid-col">
            <!--    <div class="grid-item grid-item-col-1 site-info" style="padding-bottom: 13px;"> 		 -->
            <!--     --><? //$APPLICATION->IncludeComponent(
            //	"bitrix:main.include",
            //	"",
            //	Array(
            //		"AREA_FILE_SHOW" => "file",
            //		"PATH" => "/info/tekst-rekvizity.php",
            //		"EDIT_TEMPLATE" => "standard.php"
            //	)
            //);?><!-- -->
            <!--		-->
            <!--		</div>-->
        </div>

        <div class="grid-col _margin-top">
            <div class="grid-item grid-item-col-1 _margin-bottom">
                <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "vertical",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_3",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "N",
                        "ADD_NOFOLLOW" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>
            </div>
            <div class="grid-item grid-item-row-4 grid-item-col-1 _margin-bottom">
                <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "vertical",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "news_right_1",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "N",
                        "ADD_NOFOLLOW" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>
            </div>
            <div class="grid-item grid-item-col-1 _margin-bottom">
                <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "vertical",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_5",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "N",
                        "ADD_NOFOLLOW" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>
            </div>
        </div>
    </section>
    <!-- <div class="clearfix"> </div>
 <section class="_margin-top _grid-section _margin-bottom"> 
  <div class="grid-col"> 	 
    
	  <? //endif;?>
   </div>
   </div>
 </section> -->
    <script>
//        $(".div_").bind("click", function () {
//            window.location = "/subscribe/your_lic/";
//        });

//        $(".div_lic").bind("click", function () {
//            $(".icon1").css('display', 'none');
//            $(".div_").css('display', 'block');
//            $(".electro").css('display', 'block');
//            $(".print").css('display', 'block');
//            $(".div_lic").removeClass('less');
//            $("#tabs-1").removeClass('less');
////            $("#tabs-2").css('display', 'flex');
//            $("#toTopHover").trigger("click");
//        });
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
<?
//pp($_POST);
//if (isset($_POST['buySub'])) {
//    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
//        if (basket(4829) || basket(4830)) {
//            LocalRedirect(SITE_DIR . "personal/basket.php");
//        } else {
//
//            if (isset($_POST["subscription"])) {
//                $QUANTITY = 3;
//                if (isset($_POST["var_1"])) {
//                    $PRODUCT_ID = intval($_POST["var_1"]);
//                }
//                if (isset($_POST["var_2"])) {
//                    $PRODUCT_ID = intval($_POST["var_2"]);
//                    $QUANTITY = 6;
//                }
////                $PRODUCT_ID = intval($_POST["subscription"]);
//                //echo $PRODUCT_ID."/".$QUANTITY;
//                Add2BasketByProductID(
//                    $PRODUCT_ID,
//                    $QUANTITY,
//                    false
//                );
//                LocalRedirect(SITE_DIR . "personal/basket.php");
//            } else {
//                echo "Нет параметров ";
//            }
//        }
//    } else {
//        echo "Не подключены модули";
//    }
//}
///*  		}  */
//
//
////находится ли товар уже в корзине? не даем покупать более 1 электронного экземпляра
//function basket($id)
//{
//    $cntBasketItems = CSaleBasket::GetList(
//        array(),
//        array(
//            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
//            "LID" => SITE_ID,
//            "ORDER_ID" => "NULL",
//            "PRODUCT_ID" => $id,
//        ),
//        array()
//    );
//
//    if ($cntBasketItems > 0) return true;
//
//    return false;
//}

?>