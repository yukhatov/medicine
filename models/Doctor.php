<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 08.10.16
 * Time: 17:05
 */
namespace app\models;
use app\models\Access;
use Yii;

class Doctor extends User
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'doctor';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public function setUser(User $user)
    {
        $this->userId = $user->getId();
    }

    public function getShift()
    {
        return $this->hasOne(Shift::className(), ['shiftId' => 'shiftId']);
    }

    public function getAccess()
    {
        return Access::find()
            ->where(['who' => Yii::$app->user->identity->doctor->doctorId])
            ->andWhere(['for' => $this->doctorId])->one();
    }
}