<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
$( document ).ready(function()
{
	$('#wishaction').click(function()
	{
		if ($('#wishaction').attr('act')=='add')
		{
			$.post( "/ajax.php", { "pid": $('#wishaction').attr('pid'), "act":"add"},function( data ) {
		  	if (data==1)
		  	{
		  		$('#wishaction').attr('act','del');
		  		$('#wishaction').html('Удалить из желаний');
		  		alert('Добавлено');
		  	} else alert('Не добавлено');
			});
		} else
		if ($('#wishaction').attr('act')=='del')
		{
			if (confirm("Вы действительно удалить?")) {
				$.post( "/ajax.php", { "pid": $('#wishaction').attr('pid'), "act":"del"},function( data ) {
			  	if (data==1)
			  	{
			  		$('#wishaction').attr('act','add');
			  		$('#wishaction').html('Добавить в желания');
			  		alert('Удалено');
			  	} else alert('Не удалено');
				});
			}
		}
	});
});
</script>
<button id="wishaction" pid="<?=$arResult['pid'];?>" act="<? echo (($arResult['inwish']==1)?'del':'add');?>">
<? echo (($arResult['inwish']==1)?'Удалить из желаний':'Добавить в желания'); ?></button>