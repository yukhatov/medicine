<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 08.10.16
 * Time: 17:05
 */
namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Shift extends ActiveRecord
{

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'shift';
    }
}