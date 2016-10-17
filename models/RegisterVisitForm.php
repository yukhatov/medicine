<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 11.10.16
 * Time: 16:00
 */
namespace app\models;

use Yii;
use yii\base\Model;

class RegisterVisitForm extends Model
{
    public $date;
    public $duration;
    public $comment;

    public function rules()
    {
        return [
            [['date', 'duration', 'comment'], 'required'],
            ['duration', 'hour'],
            ['date', 'busy'],
        ];
    }

    public function hour($attribute)
    {
        if (!preg_match('/^[0-9]{1,2}$/', $this->$attribute) || $this->$attribute > 60 || $this->$attribute < 1) {
            $this->addError($attribute, 'must within an hour.');
        }
    }

    public function busy($attribute)
    {
        $userId = Yii::$app->user->identity->getId();
        $patient = Patient::findOne(['userId' => $userId]);

        $visits = Visit::findAll(['doctorId' => $patient->doctorId]);
        $date = strtotime($this->$attribute);
        $occupied = false;

        foreach ($visits as $visit) {

            $timeStart = strtotime($visit->date);
            $timeEnd = $timeStart + ($visit->duration * 60);

            if($date > $timeStart && $date < $timeEnd)
            {
                $occupied = true;

                break;
            }
        }

        if ($occupied) {
            $this->addError($attribute, 'This time is already taken');
        }
    }
}