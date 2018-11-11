<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $from_date = '';
        $to_date = '';
        $this->calOrder();
        return $this->render('index_2',[
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]
            );
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
            return $this->goBack();
        } else {
            $model->password = '';
            $this->layout = false;
            return $this->render('_login', [
                'model' => $model,
            ]);
        }
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
    public function actionResetpassword(){
        $model=new \backend\models\Resetform();
        if($model->load(Yii::$app->request->post())){

            $model_user = \backend\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            if($model_user->validatePassword($model->oldpw)){
                $model_user->setPassword($model->confirmpw);
                $model_user->save();
                return $this->redirect(['site/index']);
            }else{
                $session = Yii::$app->session;
                $session->setFlash('msg_err','รหัสผ่านเดิมไม่ถูกต้อง');
            }

        }
        return $this->render('_setpassword',[
            'model'=>$model
        ]);
    }
    public function calOrder(){
      $model = \backend\models\Order::find()->all();
      $list = [];
      if($model){
          foreach($model as $value){
              array_push($list,['order_no'=>$value->order_no,'req_date'=>$value->appoinment_date]);
          }
      }
      if(count($list)>0){
          $this->sendnotify($list);
          $this->createMessage($list);
      }
    }
    public function sendnotify($list){

        $message = 'ทดสอบส่งข้อความจากระบบตรวจสอบสถานะใบสั่งผลิต';

        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = 'qy65Mp76Uar44cybVMXvprCiSW61zJjbRQdpJwh48CM'; // octopus

        header('Content-Type: text/html; charset=utf-8');

        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $line_token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
    public function createMessage($list){
        if(count($list)>0){
            $model = new \backend\models\Message();
            $model->title = "แจ้งเตือน";
            $model->message_type = 0;
            $model->detail = $list[0]['order_no'];
            $model->save(false);
        }
    }
}
