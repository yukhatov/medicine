<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 17:09
 */
namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Visit extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'visit';
    }

    public static function setStatus($id, $status)
    {
        Yii::$app->db->createCommand('UPDATE visit SET isActive=' . $status . ' WHERE visitId=' . $id)
            ->execute();
    }

    public static function setComment($id, $comment)
    {
        Yii::$app->db->createCommand('UPDATE visit SET comment="' . $comment . '" WHERE visitId=' . $id)
            ->execute();
    }

    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['patientId' => 'patientId']);
    }

    public function getDoctor()
    {
        return $this->hasOne(Docotr::className(), ['doctorId' => 'doctorId']);
    }

}