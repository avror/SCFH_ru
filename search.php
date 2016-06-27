<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "поиск");
$APPLICATION->SetPageProperty("keywords", "поиск");
$APPLICATION->SetPageProperty("title", "Поиск | Наука из первых рук");
$APPLICATION->SetTitle("Поиск | Наука из первых рук");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"scfh_search_page", 
	array(
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "N",
		"CHECK_DATES" => "Y",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "arrFilter",
		"arrFILTER" => array(
			0 => "no",
		),
		"SHOW_WHERE" => "N",
		"arrWHERE" => array(
			0 => "iblock_tags",
			1 => "iblock_books",
			2 => "iblock_content",
			3 => "iblock_faculty",
			4 => "iblock_magazine",
		),
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "50",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"SHOW_ITEM_TAGS" => "Y",
		"TAGS_INHERIT" => "Y",
		"SHOW_ITEM_DATE_CHANGE" => "Y",
		"SHOW_ORDER_BY" => "Y",
		"SHOW_TAGS_CLOUD" => "N",
		"TAGS_SORT" => "CNT",
		"TAGS_PAGE_ELEMENTS" => "100",
		"TAGS_PERIOD" => "",
		"TAGS_URL_SEARCH" => "",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "0",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "N",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"STRUCTURE_FILTER" => "structure",
		"NAME_TEMPLATE" => "",
		"SHOW_LOGIN" => "Y",
		"arrFILTER_main" => "",
		"arrFILTER_iblock_simple" => array(
			0 => "all",
		),
		"arrFILTER_blog" => array(
			0 => "all",
		),
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "scfh_search_page"
	),
	false
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>