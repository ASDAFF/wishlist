<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

$itemsOnPage = $arResult["ELEMENTS_ON_PAGE"];
$navResult = new CDBResult();
$navResult->NavPageCount = 10;
$navResult->NavPageNomer = $arResult["PAGE_NUMBER"];
$navResult->NavPageSize = 1;
$navResult->NavRecordCount = $arResult["TOTAL_ITEMS_COUNT"];
$APPLICATION->IncludeComponent('bitrix:system.pagenavigation', '', array(
    'NAV_RESULT' => $navResult,
));?>
</br>
<?foreach($itemsOnPage as $res => $item)
{?>
    <a href="<?echo $item['PROPERTY_ELEMENT_HREF_VALUE']?>">
        <h3><?echo $item['PROPERTY_ELEMENT_TITLE_VALUE']?></h3>
        <img src="<?echo $item['PROPERTY_ELEMENT_PIC_VALUE']?>" />
     </a>
    
<?}

?>