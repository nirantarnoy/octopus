<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Json;

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

        $model = \backend\models\Order::find()->select([
            'order.id','order.order_no','order.customer_name','order.order_admin',
            'order.appointment_date','order.order_admin','order.order_status','order.order_type',
            'user.username as admin_name'
        ])
            ->join('left join','user','user.id = order.order_admin')
            ->where(['order_type'=>1])->all();

        print_r($model);return;

        $from_date = '';
        $to_date = '';

        $find_date = null;
        if(Yii::$app->request->isGet){
            $find_date = explode(' ถึง ',Yii::$app->request->get('date_select'));
        }
        if(count($find_date)>0 && Yii::$app->request->get('date_select') != null) {
            $from_date = $find_date[0];
            $to_date = $find_date[1];

         //   $received_amt = \backend\models\Prodrecline::find()->where(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->sum('qty * price');

            $this->calOrder();
            $order_all = \backend\models\Order::find()->where(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $order_late = \backend\models\Order::find()->where(['>','appointment_date',strtotime(date('d-m-Y'))])->all();
            $order_process = \backend\models\Order::find()->where(['>','order_status',2])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $order_will_complete = \backend\models\Order::find()->where(['>','order_status',9])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();

        }else{
            $this->calOrder();
            $order_all = \backend\models\Order::find()->all();
            $order_late = \backend\models\Order::find()->where(['>','appointment_date',strtotime(date('d-m-Y'))])->all();
            $order_process = \backend\models\Order::find()->where(['>','order_status',2])->all();
            $order_will_complete = \backend\models\Order::find()->where(['>','order_status',9])->all();
        }



        return $this->render('index_2',[
                'from_date' => $from_date,
                'to_date' => $to_date,
                'order_all' => $order_all,
                'order_late' => $order_late,
                'order_process' => $order_process,
                'order_will_complete'=>$order_will_complete,
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

      //  return $this->goHome();
        return $this->redirect(['site/login']);
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
              if(1>1) {
                  array_push($list, ['order_no' => $value->order_no, 'req_date' => $value->appoinment_date]);
              }
          }
      }
      if(count($list)>0){
          $this->sendnotify($list);
          $this->createMessage($list);
      }
    }
    public function sendnotify($list){

        if(count($list)>0) {
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
    public function actionFindjob(){
        $type = Yii::$app->request->post('type');
        $list = [];
        if($type){
            $model = \backend\models\Order::find()->select([
                'order.id','order.order_no','order.customer_name',
                'order.appointment_date','order.order_admin','order.order_status','order.order_type',
                'user.username as admin_name'
            ])
                ->join('LEFT OUTER JOIN','user','order.order_admin = user.id')
                ->where(['order_type'=>$type])->all();
            if($model){
                return Json::encode($model);
            }else{
                return Json::encode($list);
            }
        }
        return Json::encode($list);
    }
}
