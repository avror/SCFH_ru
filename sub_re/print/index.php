<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "подписка");
$APPLICATION->SetPageProperty("keywords", "подписка");
$APPLICATION->SetPageProperty("title", "Подписка | Наука из первых рук");
$APPLICATION->SetTitle("Подписка | Наука из первых рук");

IncludeTemplateLangFile(__FILE__);
if ($USER->IsAuthorized()) {
    $id = "true";
}
else $id = "false";
?>
<script>
    $( document ).ready(function() {
        $("input[name='web_form_submit']").addClass("hidden");
        $("input[value='Применить']").addClass("hidden");
    });
</script>
    <section class="_margin-top _grid-section _margin-bottom">
        <div class="grid-col">
            <div class="grid-item grid-item-col-3 site-info _margin-top">
                <div id="tabs">
                    <ul style="display: none">
                        <li><a href="#tabs-2">Подписка для физлиц</a></li>
                        <li><a href="#tabs-1">Подписка для физлиц</a></li>
                    </ul>
                    <div id="tabs-1">
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
                    </div>
                    <div id="tabs-2" class="print_">
                        <div class="icon1" style="display: block">
                            <i class="icon icon_ purch-sprite-subs_print"></i>
                        </div>
                        <div class="">
                            <?
                            $PRICE_TYPE_ID = 1;

                            $arSelect = Array("NAME", "ID");
                            $arFilter = Array("IBLOCK_ID" => IBLOCK_SUBS_PRINT_ID, "ACTIVE" => "Y");
                            $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);

                            ?>
                            <div class="print__">
                                <form method="POST" id="buySub">
                                    <input type="hidden" id="buySub" name="buySub" value="buySub"/>

                                    <div class="_margin-top purchase-buttons ">
                                        <ul class="purchase-link-list">
                                            <li>
                                                <div class="var_1">Выберите вариант подписки на печатную версию</div>
                                                <div class="img marg">
                                                    <img src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                                </div>
                                                <select name="subscription" class="select" size="1"
                                                        style="height: 40px;width: 343px;margin-bottom: 15px;">
                                                    <? while ($ob = $res->GetNextElement()) {

                                                        $arFields = $ob->GetFields();
                                                        //pp($arFields);
                                                        $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $arFields["ID"]));//, 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));
                                                        if ($arPrice = $rsPrices->Fetch()) {
                                                            $PRICE_ = (int)$arPrice["PRICE"];
                                                            //pp($arPrice);
                                                            ?>
                                                            <option id="<?=$PRICE_?>" value="<?= $arFields["ID"] ?>" selected=""><?= $arFields["NAME"] ?>
                                                                - <?= CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]); ?> </option>

                                                        <? }
                                                    } ?>
                                                </select>
                                                <br>
                                                Количество комплектов: <input type="number" id="compl" name="compl"
                                                                              value="1" min="1"/>
                                            </li>
                                        </ul>
                                        <div class="var_2">Заполните форму:</div>
                                        <div class="hidden" id="<?=$id?>"></div>
                                        <div class="img">
                                            <img src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
                                        </div>
                                        <div class="Sub_begin">
                                            Если не указан конкретный период, подписка оформляется с месяца, следующего за месяцем платежа
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="hidden_h3">
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
                <div class="desc_">
                    &nbsp;
                    &nbsp;
                    Нажимая на кнопки оплаты, вы соглашаетесь с <a href="/info/offer.php">ПУБЛИЧНОЙ ОФЕРТОЙ</a>
                </div>
                <div class="buttons_to_submit">
                    <div style="display: flex">
                        <div class="account" onclick="Print(2, 3)">Получить счет на оплату подписки</div>
                        <div class="robocassa" onclick="Print(1, 3)">Оплатить подписку через Робокассу*</div>
                    </div>
                    <div class="desc_">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default", array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/robo_desc.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                            false
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-col">

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
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

?>