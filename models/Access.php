<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 09.10.16
 * Time: 15:38
 */
namespace app\models;
use yii\db\ActiveRecord;
use Yii;


class Access extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'access';
    }

    public static function setAccess($status, $id)
    {
        if(!$status)
        {
            $access = Access::find()
                ->where(['who' => Yii::$app->user->identity->doctor->doctorId])
                ->andWhere(['for' => $id])->one();

            $access->delete();
        }else{
            $access = new Access();
            $access->who = Yii::$app->user->identity->doctor->doctorId;
            $access->for = $id;

            $access->save();
        }
    }
}