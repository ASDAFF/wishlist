<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['count']==0):
?>
<h1>В списке желаний пока пусто!
<? else:?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">

function del(pid)
{
	if (confirm("Вы действительно удалить?")) {
	$.post( "/ajax.php", { "pid": pid, "act":"del"},function( data ) {
  	if (data==1)
  		$("#p"+pid).hide('slow');
    else
      alert('Не удалено');
	});
	}
}

</script>
<style type="text/css">
button {margin: 5px;}
</style>
<table id="nav_start" class="table table-bordered">
    <thead>
      <tr>
        <th style="width:83px">Картинка</th>
        <th>Название товара</th>
        <th style="width:80px">Действие</th>
      </tr>
    </thead>
    <tbody>
    <? foreach ($arResult['items'] as $i):?>
      <tr id="p<?=$i['id']?>">
        <td><img src="<?=$i['image']?>" style="align:middle;height:83px;"></td>
        <td><a href="<?=$i['url']?>"><?=$i['name']?></a></td>
        <td><button id="bp<?=$i['id'];?>" onclick="del(<?=$i['id'];?>)">Удалить</button></td>
      </tr>
    <? endforeach;?>
    </tbody>
  </table>
  <center>
<? foreach ($arResult['pag'] as $title=>$page):
?>
<a href="/wishlist/?page=<?=$page?>"><button><?=$title?></button></a>
<?endforeach;?>
</center>
<?endif;?>