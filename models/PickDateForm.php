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

class PickDateForm extends Model
{
    public $date;

    public function rules()
    {
        return [
            [['date'], 'safe'],
        ];
    }
}