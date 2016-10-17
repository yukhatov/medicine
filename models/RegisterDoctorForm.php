<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 09.10.16
 * Time: 15:12
 */

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterDoctorForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $specialization;
    public $group = 'DOCTOR';

    public function rules()
    {
        return [
            [['username', 'password', 'name', 'specialization'], 'required'],
        ];
    }
}