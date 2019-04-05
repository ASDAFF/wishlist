<?
use Bitrix\Main\Entity;
class WishListTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'wishlist';
    }
    
    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\IntegerField('UID', array(
            	'required' => true)),
            new Entity\IntegerField('PID', array(
            	'required' => true))            
        );
    }

}
