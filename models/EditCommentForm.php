<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 12.10.16
 * Time: 11:25
 */
namespace app\models;
use yii\base\Model;

class EditCommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
        ];
    }
}