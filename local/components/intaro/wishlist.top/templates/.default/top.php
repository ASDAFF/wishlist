<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th colspan="2" style="text-align:center">Название</th>
      </tr>
    </thead>
    <tbody>
    <? foreach ($arResult['items'] as $n=>$i):?>
      <tr>
        <td><?=($n+1);?></td>
        <td><img src="<?=$i['image']?>" style="align:middle;height:50px;"></td>
        <td style="font-size:18px"><a href="<?=$i['url']?>"><?=$i['name']?></a></td>
      </tr>
    <? endforeach;?>
    </tbody>
  </table>
  <? if ($arResult['uid']>0):?>
  <a href="/wishlist/?page=1">Перейти в список моих желаний</a>
  <? endif;?>