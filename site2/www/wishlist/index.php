<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список желаний");
?>

<? $APPLICATION->IncludeComponent(
"intaro:wishlist",
".default",
array(),
false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>