<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//подключаем сущность
include($_SERVER["DOCUMENT_ROOT"].'/local/wishlisttable.php');

//получаем id юзера
$uid=CUser::GetID();

//проверяем id юзера
if ($uid>0)
{
	//проверяем ajax запрос && проверяем, чтобы id товара был > 0
	if (isset($_POST['act']) && (int)($_POST['pid']>0))
	{
		//получаем id продукта из POST массива
		$pid=(int)$_POST['pid'];
		//добавления в wishlist
		if ($_POST['act']=='add')
		{
			//ищем pid из запроса в wishlist'e текущего пользователя
			$result=WishListTable::getList(array(
		    	'select'  => array('*'),
		    	'filter'  => array('=UID'=>$uid,'=PID'=>$pid)
		    ))->fetchAll();
		    //если не найдено
			if (count($result)==0)
			{
				//добавляем
				$result = WishListTable::add( array(
					'UID' => $uid,
					'PID' => $pid
					));	
				//если запросы выполнен
				if ($result->isSuccess())
				{
					//выводим 1
					echo 1;
				} 
					//иначе 0
					else echo 0;
			} else
			//попытка добавления дубля в wishlist, 
			//выводим 0
			echo 0;
		} 
		elseif ($_POST['act']=='del')
		{
			//ищем id по uid и pid
			$result=WishListTable::getList(array(
		    	'select'  => array('ID'),
		    	'filter'  => array('=UID'=>$uid,'=PID'=>$pid)
		    ))->fetchAll();
		    //если нашли
		    if (count($result)==1)
		    {
			    //удаляем
				$result=WishListTable::delete($result[0]['ID']);
				//если запросы выполнен
				if ($result->isSuccess())
				{
					//выводим 1
					echo 1;
				}
					//иначе 0
					else echo 0;
			} else
			//не нашли в wishlist'e юзера
			//выводим 0
			echo 0;
		}
	}
	//запрос не ajax, проверяем pid
	elseif (isset($arParams['pid']))
	{
	//id продукта
	$pid=$arParams['pid'];
	//ищем pid в wishlist'e юзера
	$result=WishListTable::getList(array(
	    	'select'  => array('ID'),
	    	'filter'  => array('=UID'=>$uid,'=PID'=>$pid)
	    ))->fetchAll();
	//если не найдено
	if (count($result)==0)
	//ставим элемент inwish в 0
	$arResult['inwish']=0;
	else 	
	//иначе 1
	$arResult['inwish']=1;
	//передаем pid
	$arResult['pid']=$pid;
	//подключаем шаблон
	$this->IncludeComponentTemplate('productpage');	
	}
}
