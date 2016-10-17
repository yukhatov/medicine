<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 16.10.16
 * Time: 17:20
 */

namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->group;
            if ($item->name === 'DOCTOR') {
                return $group == 'DOCTOR';
            } elseif ($item->name === 'PATIENT') {
                return $group == 'PATIENT';
            }
        }
        return true;
    }
}