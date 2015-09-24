<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//подключаем сущность
include($_SERVER["DOCUMENT_ROOT"].'/local/wishlisttable.php');

//получаем id юзера
$uid=CUser::GetID();

$arResult=array();

//получаем кол-во элементов в wishlist'e юзера
$result=WishListTable::getList(array(
    'select'  => array('*'),
    'filter'  => array('=UID'=>$uid)))->fetchAll();
$all=count($result);
$arResult['count']=$all;
//если элементов > 0
if ($all>0)
{
	//пагинация
	$last=(int)($all/5);
	if ($all%5!=0) $last=$last+1;
	$page=(int)$_GET['PAGEN_1'];

	if (($page<1) || ($page>$last))
	LocalRedirect("/wishlist/?PAGEN_1=1");

	$offset=($page>1)?($page-1)*5:0;

	$pagination=new CDBResult;
	$pagination->InitFromArray($result);
	$pagination->NavStart(5, false);

	//получаем wishlist юзера
	$result1=WishListTable::getList(array(
	    'select'  => array('*'),
	    'filter'  => array('=UID'=>$uid),
	    'group'   => array('ID'),
	    'order'   => array('ID'=>'DESC'),
	    'limit'   => 5,
	    'offset'  => $offset,
	    'runtime' => array()
	))->fetchAll();


	foreach ($result1 as $r1)
	{
		$item=[];
		//получаем данные о товаре
		$result2=CIBlockElement::GetByID($r1['PID']);
		if ($r2=$result2->GetNext())
		{
			$item['id']=$r1['PID'];
			$item['url']=$r2['DETAIL_PAGE_URL'];
			$item['name']=$r2['NAME'];
			$item['image']=CFile::GetPath($r2['DETAIL_PICTURE']);
			$arResult['items'][]=$item;
		}
	}
}
$this->IncludeComponentTemplate("wishlist");
if($pagination->IsNavPrint())
{
	echo '<center>';
	$pagination->NavPrint('');
	echo '</center>';
}
