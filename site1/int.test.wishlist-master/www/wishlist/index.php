<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список желаемого");
?>
<? $APPLICATION->IncludeComponent(
        "intaro:wishlist",
        ".default",
        Array(
        ),
        false
        );
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>