<?php

namespace app\controllers;

use app\models\Doctor;
use app\models\Patient;
use app\models\RegisterDoctorForm;
use app\models\RegisterPatientForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isset(Yii::$app->user->identity))
        {
            if(Yii::$app->user->identity->group == self::GROUP_PATIENT)
            {
                return $this->redirect('index.php?r=patient');
            }

            if(Yii::$app->user->identity->group == self::GROUP_DOCTOR)
            {
                return $this->redirect('index.php?r=doctor');
            }
        }

        return $this->render('index');
    }

    public function actionRegisterDoctor()
    {
        $model = new RegisterDoctorForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $doctor = new Doctor();
            $doctor->specialization = $model->specialization;
            $doctor->setUser(new User($model));
            $doctor->save();

            return $this->render('index');
        } else {
            return $this->render('register-doctor', ['model' => $model]);
        }
    }

    public function actionRegisterPatient()
    {
        $model = new RegisterPatientForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User($model);
            $patient = new Patient();
            $patient->doctorId = $model->doctor;
            $patient->setUser($user);
            $patient->save();

            return $this->render('index');

        } else {
            return $this->render('register-patient', ['model' => $model]);
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
