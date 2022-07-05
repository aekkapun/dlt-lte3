<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Config;

use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','index','admin'],
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
     * {@inheritdoc}
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
        if (@Yii::$app->user->identity->role==99){
            return $this->render('index-admin');
        } else if (@Yii::$app->user->identity->role==10){
            return $this->render('index');
        } else {
            return $this->redirect(['site/login']);
        }
    }
    public function actionAdmin()
    {
        if (@Yii::$app->user->identity->role==99){
            return $this->render('index-admin');
        } else if (@Yii::$app->user->identity->role==10){
            return $this->render('index');
        } else {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    
    public function actionLoginx()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

  

    /**
     * Logout action.
     *
     * @return Response
     */

      public function actionLogin()
    {
        $this->layout = 'main-login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $url  = Config::findOne(['code' => 'A002'])->value;
            $onService  = Config::findOne(['code' => 'A001'])->value;

            if($onService=='N'){
                if ($model->login()){
                    return $this->goBack();
                }
            }else{
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('post')
                ->setHeaders(['content-type' => 'application/json'])
                ->setUrl($url)
                ->setData([
                    'username' => $model->username,
                    'password' => $model->password,
                ])
                ->send();

            $rawdata = Json::decode($response->content);
            $data = $rawdata['data'];
            $datax = Json::decode($response->content);
            //VarDumper::dump($datax);
          //  exit();
            if($datax['status']==1){
                $user =  User::find()->where(['username'=>$data['id']])->one();
                if ($user){
                    $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                    $user->id_no = $data['id'];
                    $user->username = $data['username'];
                    $user->password_reset_token = $data['accessToken'];
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->title = $data['title'];
                    $user->name = $data['name'];
                    $user->surname = $data['surname'];
                    $user->positionDesc = $data['positionDesc'];
                    $user->offLocDesc = $data['offLocDesc'];
                    $user->orgFullNameDes = $data['orgFullNameDes'];
                    $user->offLocCode = $data['offLocCode'];
                    $user->status=10;
                    $user->save();
                }else{
                    $user = new User();
                    $user->username = $model->username;
                    $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    $user->id_no = $data['id'];
                    $user->password_reset_token = $data['accessToken'];
                    $user->title = $data['title'];
                    $user->name = $data['name'];
                    $user->surname = $data['surname'];
                    $user->positionDesc = $data['positionDesc'];
                    $user->offLocDesc = $data['offLocDesc'];
                    $user->orgFullNameDes = $data['orgFullNameDes'];
                    $user->offLocCode = $data['offLocCode'];
                    $user->status=10;
                    $user->save();
                }

                if ($model->login()){
                    return $this->goBack();
                }
            }else{

                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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
