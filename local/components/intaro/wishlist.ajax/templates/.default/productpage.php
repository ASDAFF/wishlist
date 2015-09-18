<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">

function del(pid)
{
	if (confirm("Вы действительно удалить?")) {		
	$.post( "/ajax.php", { "pid": pid, "act":"del"},function( data ) {
  	if (data==1)
  	{
  		$("#del").hide('slow');
  		$("#add").show('slow');
  	}
	});
	}
}
function add(pid)
{
	$.post( "/ajax.php", { "pid": pid, "act":"add"},function( data ) {
  	if (data==1)
  	{
  		$("#add").hide('slow');
  		$("#del").show('slow');
  	}
	});
}
</script>
<button id="add" <? echo (($arResult['inwish']==1)?' hidden ':''); ?>
onclick="add(<?=$arResult['pid'];?>)">Добавить в желания</button>
<button id="del" <? echo (($arResult['inwish']==0)?' hidden ':''); ?>
onclick="del(<?=$arResult['pid'];?>)">Удалить из желаний</button>

