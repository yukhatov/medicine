<?php

namespace app\controllers;

use app\models\Access;
use app\models\Doctor;
use app\models\Patient;
use app\models\Visit;
use app\models\AccessForm;
use app\models\PickDateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

class DoctorController extends Controller
{
    protected $userGroup = 'DOCTOR';

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
     * Displays doctor's homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $formModel = new PickDateForm();
        $user = Yii::$app->user->identity;
        $userId = $user->getId();
        $doctor = Doctor::findOne(['userId' => $userId]);
        $patients = Patient::findAll(['doctorId' => $doctor->doctorId]);
        $visits = Visit::findAll(['doctorId' => $doctor->doctorId]);

        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) {

            if($formModel->date)
            {
                list($from, $to) = split(' - ', $formModel->date);

                $visits = Visit::find()->where(['doctorId' => $doctor->doctorId])->andWhere("date > '" . $from . "'")->andWhere("date < '" . $to . "'")->all();
            }
        }

        $hours = self::calcHours($visits);

        return $this->render('index', ['user' => $user, 'patients' => $patients, 'visits' => $visits, 'model' => $formModel, 'hours' => $hours]);
    }

    /**
     * Displays patinet's visits.
     *
     * @return string
     */
    public function actionPatientVisits()
    {
        if(isset(Yii::$app->request->get()['id'])) {
            $user = Yii::$app->user->identity;
            $userId = $user->getId();
            $doctor = Doctor::findOne(['userId' => $userId]);
            $patient = Patient::findOne(['patientId' => Yii::$app->request->get()['id']]);
            $visits = Visit::findAll(['doctorId' => $doctor->doctorId, 'patientId' => Yii::$app->request->get()['id']]);

            if($patient)
            {
                return $this->render('visits', ['user' => $user, 'visits' => $visits, 'patient' => $patient]);
            }
            else{
                return $this->goHome();
            }
        }
        else{
            return $this->goHome();
        }
    }

    public function actionSchedules()
    {
        $formModel = new PickDateForm();

        $user = Yii::$app->user->identity;
        $userId = $user->getId();
        $doctor = Doctor::findOne(['userId' => $userId]);
        $doctors = Doctor::find()->all();
        $access = Access::findAll(['for' => $doctor->doctorId]);
        $visitsAll = array();

        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate() && $formModel->date) {
            list($from, $to) = split(' - ', $formModel->date);

            foreach ($access as $acces) {
                $visits = Visit::find()->where(['doctorId' => $acces->who])->andWhere("date > '" . $from . "'")->andWhere("date < '" . $to . "'")->all();
                $visitsAll[] = ['doctor' => Doctor::findOne(['userId' => $acces->who]), 'visits' => $visits];

            }
        }else{
            foreach ($access as $acces) {
                $visits = Visit::findAll(['doctorId' => $acces->who]);
                $visitsAll[] = ['doctor' => Doctor::findOne(['userId' => $acces->who]), 'visits' => $visits];
            }
        }

        return $this->render('schedules', ['visitsAll' => $visitsAll, 'user' => $user, 'model' => $formModel, 'doctors' => $doctors]);
    }

    public function actionAccess()
    {
        $user = Yii::$app->user->identity;
        $doctors = Doctor::find()->where('userId!=' . Yii::$app->user->identity->getId())->all();

        return $this->render('access', ['doctors' => $doctors, 'user' => $user]);
    }

    public static function calcHours(array $visits)
    {
        $totalDuration = 0;

        foreach ($visits as $visit) {
            $totalDuration += $visit->duration;
        }

        return $totalDuration / 60;
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