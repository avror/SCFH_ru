<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
define("NEED_AUTH", true);
$APPLICATION->SetPageProperty("description", "подписка");
$APPLICATION->SetPageProperty("keywords", "подписка");
$APPLICATION->SetPageProperty("title", "Подписка | Наука из первых рук");
$APPLICATION->SetTitle("Подписка | Наука из первых рук");

IncludeTemplateLangFile(__FILE__);
?>
    <section class="_margin-top _grid-section _margin-bottom">
        <div class="grid-col">
            <div class="grid-item grid-item-col-3 site-info _margin-top">
                <div id="tabs">
                    <ul style="display: none">
                        <li><a href="#tabs-2">Подписка для физлиц</a></li>
                        <li><a href="#tabs-1">Подписка для физлиц</a></li>
                    </ul>
                    <div id="tabs-2" class="print_">
                        <div class="icon1" style="display: block">
                            <i class="icon purch-sprite-subs_print"></i>
                        </div>
                        <div class="">
                            <?
                            $PRICE_TYPE_ID = 1;
                            $arSelect = Array("NAME", "ID");
                            $arFilter = Array("IBLOCK_ID" => 66, "ACTIVE" => "Y");
                            $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
                            ?>
                            <div>
                                <form method="POST" id="buySub">
                                    <input type="hidden" id="buySub" name="buySub" value="buySub"/>

                                    <div class="_margin-top purchase-buttons ">
                                        <span class="desc electro_payment">Только для электронных платежей!</span>

                                        <ul class="purchase-link-list ul">
                                            <li style="height: initial;">
                                                <div class="var_1 more">Выберите вариант подписки на электронную версию (pdf)</div>
                                                <div class="img marg">
                                                    <img
                                                        src="/files/medialibrary/329/329d416bc90a6839161945272d1ac7bb.png">
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
                                            </li>
                                        </ul>
                                        <div class="Sub_begin">
                                            Если не указан конкретный период, подписка оформляется с месяца, следующего за месяцем платежа
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="hidden_h3">
                        </div>
                    </div>
                </div>
                <div class="buttons_to_submit">
                    <div style="display: flex">
                        <div onclick="Slip(1, 1)" class="account electro_">Оформить подписку</div>
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


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>


<?

pp($_POST);
if (isset($_POST['buySub'])) {
    if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
        if (basket(4829) || basket(4830)) {
            LocalRedirect(SITE_DIR . "personal/basket.php");
        } else {

            if (isset($_POST["subscription"])) {
                $PRODUCT_ID = intval($_POST["subscription"]);
                $QUANTITY = intval($_POST["compl"]);
                //echo $PRODUCT_ID."/".$QUANTITY;
                Add2BasketByProductID(
                    $PRODUCT_ID,
                    $QUANTITY,
                    false
                );

                LocalRedirect(SITE_DIR . "personal/basket.php");
            } else {
                echo "Нет параметров ";
            }
        }
    } else {
        echo "Не подключены модули";
    }
}
/*  		}  */


//находится ли товар уже в корзине? не даем покупать более 1 электронного экземпляра
function basket($id)
{
    $cntBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "PRODUCT_ID" => $id,
        ),
        array()
    );

    if ($cntBasketItems > 0) return true;

    return false;
}

?>