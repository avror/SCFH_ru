<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Журнал НАУКА ИЗ ПЕРВЫХ РУК научно-популярный - учрежден СО РАН, Новосибирск, издательство ИНФОЛИО-ПРЕСС, новости науки");
$APPLICATION->SetPageProperty("keywords", "журнал, скачать, скачать бесплатно, скачать журнал, скачать журнал бесплатно, скачать статью, скачать статью бесплатно, купить журнал, купить статью, инфолио, книги, купить книгу, читать онлайн, читать статью онлайн, читать статью онлайн бесплатно, читать онлайн бесплатно, читать журнал бесплатно, читать журнал, скачать pdf, наука, научно-популярный, научно-популярные статьи, СО РАН, РАН, новости науки, новости медицины, научные гипотезы, новые технологии, научная экспедиция, Сибирь, этнография Сибири, коренные народы Сибири, Алтай, Байкал, Новосибирск, Принцесса Укока, пазырыкская культура, спирогира, рак, миелин, диабет, персонализированная медицина, рассеянный склероз, происхождение земли, эволюция, рнк, днк");
$APPLICATION->SetPageProperty("title", "Наука из первых рук");
$APPLICATION->SetTitle("Наука из первых рук");
?>

<? //pp(isBot()); ?>

<? $APPLICATION->IncludeComponent(
    "scfh:content.slider",
    "",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "",
        "ITEMS_LIMIT" => "5",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "TYPE" => "all",
        "STYLE" => "huge"
    )
); ?><? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "scfh_section_menu",
    Array(
        "ROOT_MENU_TYPE" => "rubrics",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(0 => "",),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "COMPONENT_TEMPLATE" => "scfh_section_menu"
    ),
    false,
    Array(
        'ACTIVE_COMPONENT' => 'Y'
    )
); ?>
    <section class="_margin-top _grid-section">
        <div class="grid-col">     <? $APPLICATION->IncludeComponent(
                "scfh:news.popular.huge2",
                "",
                Array()
            ); ?> </div>

        <div class="grid-col">     <? $APPLICATION->IncludeComponent(
                "scfh:journal.latest",
                "",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "IBLOCK_TYPE" => "magazine",
                    "ITEMS_LIMIT" => "1",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600"
                )
            ); ?>
            <div class="grid-item grid-item-row-1 grid-item-col-2 bunner _margin-bottom">         <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "horizontal",
                    Array(
                        "COMPONENT_TEMPLATE" => "horizontal",
                        "BANTYPE" => "middle_1",
                        "MODE" => "SINGLE",
                        "HIDE_WIDTH_HEIGHT" => "N",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0"
                    )
                ); ?>    </div>
            <? $APPLICATION->IncludeComponent(
                "scfh:book.latest",
                "",
                Array()
            ); ?> </div>

        <div class="grid-col">
            <div class="grid-item grid-item-row-2 grid-item-col-1 bunner _margin-bottom">         <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_3",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "Y",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>    
			</div>
			
			 <div class="grid-item grid-item-row-2 grid-item-col-1 bunner _margin-bottom">         				 
				 <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_4",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "Y",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>    
			</div>
			
			 <div class="grid-item grid-item-row-2 grid-item-col-1 bunner _margin-bottom">        
				<? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_5",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "Y",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>    
			</div>
            
			
			<? /*$APPLICATION->IncludeComponent(
                "scfh:comments.popular",
                "",
                Array()
            ); */?>

			<div class="grid-item grid-item-row-1 grid-item-col-1 bunner _margin-top">         <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_1",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "Y",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>    </div>

            <div class="grid-item grid-item-row-1 grid-item-col-1 bunner _margin-top">         <? $APPLICATION->IncludeComponent(
                    "kuznica:banner",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => "vertical",
                        "BANTYPE" => "main_right_2",
                        "MODE" => "MULTIPLE",
                        "HIDE_WIDTH_HEIGHT" => "Y",
                        "ADD_NOFOLLOW" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0",
                        "CNT" => "3"
                    )
                ); ?>    </div>
        </div>
    </section>
    <div class="clearfix"></div>

    <!--  <section class="_grid-section _margin-top">
    <div class="grid-item grid-item-row-1 grid-item-col-4 bunner">
         <img id="bxid_258490" src="//scfh.ru.opt-images.1c-bitrix-cdn.ru/bitrix/images/fileman/htmledit2/php.gif?1428114268507" border="0"/>
    </div>
     </section>  -->
    <section class="_grid-section _margin-top"> <? $APPLICATION->IncludeComponent(
            "scfh:block.photo",
            "",
            Array()
        ); ?> </section>
    <section class="_grid-section">
        <div class="grid-col">         <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "scfh_standart_block",
                Array(
                    "TITLE" => "Факультет",
                    "TITLE_URL" => "faculty/",
                    "SPRITE-CLASS" => "sprite-deck",
                    "COMPONENT_TEMPLATE" => "scfh_standart_block",
                    "IBLOCK_TYPE" => "faculty",
                    "IBLOCK_ID" => IBLOCK_LECTURE_ID,
                    "NEWS_COUNT" => "4",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(0 => "SHOW_COUNTER", 1 => "",),
                    "PROPERTY_CODE" => array(0 => "", 1 => "",),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SET_LAST_MODIFIED" => "N"
                )
            ); ?> </div>

        <div class="grid-col">     <? $APPLICATION->IncludeComponent(
                "scfh:block.video",
                "",
                Array()
            ); ?><? $APPLICATION->IncludeComponent(
                "scfh:block.audio",
                "",
                Array()
            ); ?> </div>
    </section>
    <div class="clearfix"></div>

    <!--  <section class="_grid-section _margin-top">
    <div class="grid-item grid-item-row-1 grid-item-col-4 bunner">
         <img id="bxid_417896" src="//scfh.ru.opt-images.1c-bitrix-cdn.ru/bitrix/images/fileman/htmledit2/php.gif?1428114268507" border="0"/>
    </div>
     </section>  -->
    <section class="_grid-section ">
        <div class="grid-col">
            <div class="grid-item grid-item-row-4 grid-item-col-1 faculty _margin-top">
                <? /*$APPLICATION->IncludeComponent(
	"kuznica:banner",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"BANTYPE" => "news_right_1",
		"MODE" => "SINGLE",
		"HIDE_WIDTH_HEIGHT" => "Y",
		"ADD_NOFOLLOW" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"CNT" => "1"
	)
);*/ ?>
                <!-- 	  </div> -->
                <? $APPLICATION->IncludeComponent(
                    "bitrix:blog.new_posts.list",
                    "scfh_blog_lenta",
                    Array(
                        "COMPONENT_TEMPLATE" => "scfh_blog_lenta",
                        "GROUP_ID" => "1",
                        "BLOG_URL" => "",
                        "MESSAGE_PER_PAGE" => "4",
                        "DATE_TIME_FORMAT" => "j F Y G:i",
                        "NAV_TEMPLATE" => "",
                        "IMAGE_MAX_WIDTH" => "600",
                        "IMAGE_MAX_HEIGHT" => "600",
                        "PATH_TO_BLOG" => "/blogs/#blog#/",
                        "PATH_TO_POST" => "/blogs/#blog#/#post_id#/",
                        "PATH_TO_USER" => "/blogs/user/#user_id#/",
                        "PATH_TO_GROUP_BLOG_POST" => "",
                        "PATH_TO_BLOG_CATEGORY" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "86400",
                        "PATH_TO_SMILE" => "",
                        "SET_TITLE" => "N",
                        "POST_PROPERTY_LIST" => array(),
                        "SHOW_RATING" => "N",
                        "RATING_TYPE" => "",
                        "NAME_TEMPLATE" => "#NAME# #LAST_NAME#",
                        "SHOW_LOGIN" => "Y",
                        "SEO_USER" => "N",
                        "BLOG_VAR" => "",
                        "POST_VAR" => "",
                        "USER_VAR" => "",
                        "PAGE_VAR" => ""
                    )
                ); ?>
            </div>
        </div>

        <div class="grid-col">         <? $APPLICATION->IncludeComponent(
                "scfh:standartblock.collections",
                "",
                Array(
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_NOTES" => "",
                )
            ); ?>         </div>

        <div class="grid-col">         <?

            $readingRoomFilter = array("PROPERTY" => array("PRIVATE" => 0));

            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "scfh_standart_block",
                array(
                    "TITLE" => "Читальный зал",
                    "TITLE_URL" => "reading-room/",
                    "SPRITE-CLASS" => "sprite-book2",
                    "COMPONENT_TEMPLATE" => "scfh_standart_block",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => IBLOCK_PAPERS_ID,
                    "NEWS_COUNT" => "4",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "",
                    "SORT_ORDER2" => "",
                    "FILTER_NAME" => "readingRoomFilter",
                    "FIELD_CODE" => array(
                        0 => "SHOW_COUNTER",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SET_LAST_MODIFIED" => "N",
                    "RSS_LENTA" => "http://feeds.feedburner.com/scfh" . SITE_DIR . "readroom"

                ),
                false
            ); ?>
        </div>

        <div class="grid-col">     <? $APPLICATION->IncludeComponent(
                "sotbit:we.instagram",
                "scfh_instagram",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "WIDTH" => "260",
                    "HEIGHT" => "320",
                    "INLINE" => "3",
                    "VIEW" => "15",
                    "TOOLBAR" => "Y",
                    "PREVIEW" => "small",
                    "CACHE" => "20",
                    "TITLE" => "Мы в Instagram:"
                )
            ); ?>
        </div>
    </section> <? /*if (mail("vladimir.timonov@gmail.com","test subject", "test body","From: from@mail"))
echo "Сообщение передано функции mail, проверьте почту в ящике.";
else
echo "Функция mail не работает, свяжитесь с администрацией хостинга.";*/
?>
    <br/>
<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>