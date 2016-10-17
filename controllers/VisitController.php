<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 12.10.16
 * Time: 11:02
 */

namespace app\controllers;

use app\models\Visit;
use app\models\EditCommentForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class VisitController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionVisitStatus()
    {
        Visit::setStatus(Yii::$app->request->get()['id'], Yii::$app->request->get()['status']);

        return $this->redirect('index.php?r=patient');
    }

    public function actionEditComment()
    {
        $model = new EditCommentForm();

        if(isset(Yii::$app->request->get()['id']))
        {
            $visit = Visit::findOne(['visitId' => Yii::$app->request->get()['id']]);

            if(!$visit){
                return $this->redirect('index.php?r=doctor');
            }

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                Visit::setComment( Yii::$app->request->get()['id'], $model->comment);

                return $this->goHome();
            }

            return $this->render('edit-comment', ['model' => $model, 'visit' => $visit]);
        }else{
            return $this->goHome();
        }
    }
}