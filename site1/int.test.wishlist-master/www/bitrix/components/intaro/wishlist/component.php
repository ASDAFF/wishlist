<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilter = Array(
    "IBLOCK_ID"=>4, 
    "PROPERTY_USER"=>$USER->GetId(),
);
$arSelect = Array("ID", "PROPERTY_ELEMENT_TITLE", "PROPERTY_ELEMENT_HREF", "PROPERTY_ELEMENT_PIC");
$data =CIBlockElement::GetList (
   Array(),
   $arFilter,
   false,
   Array (),
   $arSelect
);
$allItems = array();
while($iBlockEl = $data->GetNext()) {
   array_push($allItems, $iBlockEl);
}

$currentPageNumber = intval($_GET['PAGEN_1']);

if(is_null($currentPageNumber) || $currentPageNumber == 0)
{    
    $currentPageNumber = intval($_GET['PAGEN_']);
    if(is_null($currentPageNumber) || $currentPageNumber == 0){
        $currentPageNumber = 1;        
    }
}
$arResult["PAGE_NUMBER"] = $currentPageNumber;
$arResult["TOTAL_ITEMS_COUNT"] = count($allItems);
$onPageCount = 1;
$arResult["ON_PAGE_ITEMS_COUNT"] = $onPageCount;
$arResult["ELEMENTS_ON_PAGE"] = array_slice($allItems, ($currentPageNumber - 1) * $onPageCount, $onPageCount);
if ($USER->IsAuthorized()){
    $this->IncludeComponentTemplate();    
}  
?>