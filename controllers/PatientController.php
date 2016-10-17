<?php

namespace app\controllers;

use app\models\Doctor;
use app\models\Patient;
use app\models\Visit;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RegisterVisitForm;
use yii\web\ForbiddenHttpException;

class PatientController extends Controller
{
    protected $userGroup = 'PATIENT';

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

    /**
     * Displays patient's homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $userId = $user->getId();
        $patient = Patient::findOne(['userId' => $userId]);
        $visits = Visit::findAll(['patientId' => $patient->patientId]);
        $doctor = Doctor::findOne(['doctorId' => $patient->doctorId]);

        return $this->render('index', ['user' => $user, 'visits' => $visits, 'doctor' => $doctor]);
    }

    public function actionRegisterVisit()
    {
        $model = new RegisterVisitForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $userId = Yii::$app->user->identity->getId();
            $patient = Patient::findOne(['userId' => $userId]);

            $visit = new Visit();
            $visit->patientId = $patient->patientId;
            $visit->doctorId = $patient->doctorId;
            $visit->date = $model->date;
            $visit->isActive = 1;
            $visit->duration = $model->duration;
            $visit->comment = $model->comment;
            $visit->save();

            return $this->goHome();
        } else {
            return $this->render('register-visit', ['model' => $model]);
        }
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (\Yii::$app->user->identity->group != $this->userGroup) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }
}