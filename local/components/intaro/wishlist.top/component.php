<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//подключаем сущность
require_once($_SERVER["DOCUMENT_ROOT"].'/local/wishlisttable.php');

use Bitrix\Main\Entity;

if ($this->StartResultCache(3600))
{
$result1=WishListTable::getList(array(
    'select'  => array('PID','CNT'),
    'group'   => array('PID'),
    'order'   => array('CNT' => 'DESC'),
    'limit'   => 3,
    'runtime' => array(
        new Entity\ExpressionField('CNT', 'count(PID)')
    )
))->fetchAll();
$arResult=array();
$arResult['uid']=CUser::GetID();
foreach ($result1 as $r1)
{
	$item=[];
	//получаем данные о товаре
	$result2=CIBlockElement::GetByID($r1['PID']);
	if ($r2=$result2->GetNext())
	{
		$item['url']=$r2['DETAIL_PAGE_URL'];
		$item['name']=$r2['NAME'];
		$item['image']=CFile::GetPath($r2['DETAIL_PICTURE']);
		$arResult['items'][]=$item;
	}
}
}
$this->IncludeComponentTemplate("top");