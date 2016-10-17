<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 09.10.16
 * Time: 16:07
 */
namespace app\models;

use Yii;
use yii\base\Model;

class RegisterPatientForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $doctor;
    public $group = 'PATIENT';

    public function rules()
    {
        return [
            [['username', 'password', 'name', 'doctor'], 'required'],
        ];
    }
}