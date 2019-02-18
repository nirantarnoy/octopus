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
//        $x = '(4,15)';
//        $sql = "SELECT t1.*,t2.username FROM `order` as t1 inner join `user` as t2 on t2.id = t1.order_admin WHERE t1.order_status in ".$x;
//        $model = Yii::$app->db->createCommand($sql)->queryAll();
//
//        echo $sql;
//        print_r($model);return;

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

            //$this->calOrder();
            $order_all = \backend\models\Order::find()->where(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $order_late = \backend\models\Order::find()->where(['>','appointment_date',strtotime(date('d-m-Y'))])->all();
            $order_process = \backend\models\Order::find()->where(['>','order_status',2])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $order_will_complete = \backend\models\Order::find()->where(['>','order_status',9])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();

            $wait_confirm = \backend\models\Order::find()->where(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->andFilterWhere(['order_status'=>[1,12]])->all();
            $confirm1 = \backend\models\Order::find()->where(['order_status'=>[2,13]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $confirm2 = \backend\models\Order::find()->where(['order_status'=>[3,14]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $confirm3 = \backend\models\Order::find()->where(['order_status'=>[4,15]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $prepare = \backend\models\Order::find()->where(['order_status'=>[5]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $produce = \backend\models\Order::find()->where(['order_status'=>[6,16]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $ass = \backend\models\Order::find()->where(['order_status'=>[7]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $qc = \backend\models\Order::find()->where(['order_status'=>[8,17]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $fordel = \backend\models\Order::find()->where(['order_status'=>[9]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $del = \backend\models\Order::find()->where(['order_status'=>[10]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $complete = \backend\models\Order::find()->where(['order_status'=>[11,21]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $appoint = \backend\models\Order::find()->where(['order_status'=>[18]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $install = \backend\models\Order::find()->where(['order_status'=>[19]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
            $installcomplete = \backend\models\Order::find()->where(['order_status'=>[20]])->andFilterWhere(['BETWEEN','created_at',strtotime($from_date),strtotime($to_date)])->all();
        }else{
            //$this->calOrder();
            $order_all = \backend\models\Order::find()->all();
            $order_late = \backend\models\Order::find()->where(['>','appointment_date',strtotime(date('d-m-Y'))])->all();
            $order_process = \backend\models\Order::find()->where(['>','order_status',2])->all();
            $order_will_complete = \backend\models\Order::find()->where(['>','order_status',9])->all();

            $wait_confirm = \backend\models\Order::find()->where(['order_status'=>[1,12]])->all();
            $confirm1 = \backend\models\Order::find()->where(['order_status'=>[2,13]])->all();
            $confirm2 = \backend\models\Order::find()->where(['order_status'=>[3,14]])->all();
            $confirm3 = \backend\models\Order::find()->where(['order_status'=>[4,15]])->all();
            $prepare = \backend\models\Order::find()->where(['order_status'=>[5]])->all();
            $produce = \backend\models\Order::find()->where(['order_status'=>[6,16]])->all();
            $ass = \backend\models\Order::find()->where(['order_status'=>[7]])->all();
            $qc = \backend\models\Order::find()->where(['order_status'=>[8,17]])->all();
            $fordel = \backend\models\Order::find()->where(['order_status'=>[9]])->all();
            $del = \backend\models\Order::find()->where(['order_status'=>[10]])->all();
            $complete = \backend\models\Order::find()->where(['order_status'=>[11,21]])->all();
            $appoint = \backend\models\Order::find()->where(['order_status'=>[18]])->all();
            $install = \backend\models\Order::find()->where(['order_status'=>[19]])->all();
            $installcomplete = \backend\models\Order::find()->where(['order_status'=>[20]])->all();
        }

        $this->calOrder();

        //$system_message = \backend\models\Message::find()->where(['status'=>0])->all();


        return $this->render('index_2',[
                'from_date' => $from_date,
                'to_date' => $to_date,
                'order_all' => $order_all,
                'order_late' => $order_late,
                'order_process' => $order_process,
                'order_will_complete'=>$order_will_complete,
                'wait_confirm'=>$wait_confirm,
                'confirm1'=>$confirm1,
                'confirm2'=>$confirm2,
                'confirm3'=>$confirm3,
                'prepare'=>$prepare,
                'produce'=>$produce,
                'ass'=>$ass,
                'qc'=>$qc,
                'for_del'=>$fordel,
                'del'=>$del,
                'complete'=>$complete,
                'appoint'=>$appoint,
                'install'=>$install,
                'installcom'=>$installcomplete,
              //  'system_message' => $system_message
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
      //$this->calFor24deliver();
      //$this->calForAfter48();
      //$this->calForCompeted();
    }
    public function calFor24deliver(){
        $list = [];
        $model = \backend\models\Order::find()->where(['AND',['!=','order_status',[11,21]],['!=','appointment_date','NULL']])->all();
        if($model){
            foreach($model as $value){
                $ndate = strtotime(date('d/m/Y'));
                $sdate = strtotime($value->appointment_date);
                $appoint_alert = ($ndate - $sdate)/(60*60*24);
                if($appoint_alert <= 1) {
                    array_push($list, ['title'=>\backend\helpers\NotifyType::getTypeById(1),'order_no' => $value->order_no, 'req_date' => $value->appointment_date]);
                }
            }
        }
        if(count($list)>0){
            $this->sendnotify($list);
            $this->createMessage($list);
            return false;
        }
    }
    public function calForAfter48(){
        $list = [];
        $model = \backend\models\Order::find()->where(['order_status'=>[10,20]])->all();
        if($model){
            foreach($model as $value){
                $ndate = strtotime(date('d/m/Y'));
                $sdate = strtotime($value->appointment_date);
                $appoint_alert = ($ndate - $sdate)/(60*60*24);
                if($appoint_alert >= 2) {
                    array_push($list, ['title'=>\backend\helpers\NotifyType::getTypeById(2),'order_no' => $value->order_no, 'req_date' => $value->appointment_date]);
                }
            }
        }
        if(count($list)>0){
            $this->sendnotify($list);
            $this->createMessage($list);
            return false;
        }
    }
    public function calForCompeted(){
   //     $list = [];
   //     $model = \backend\models\Order::find()->where(['order_status'=>[10,20]])->all();
//        if($model){
//            foreach($model as $value){
//                $ndate = strtotime(date('d/m/Y'));
//                $sdate = strtotime($value->appointment_date);
//                $appoint_alert = ($ndate - $sdate)/(60*60*24);
//                if($appoint_alert >= 2) {
//                    array_push($list, ['title'=>\backend\helpers\NotifyType::getTypeById(2),'order_no' => $value->order_no, 'req_date' => $value->appointment_date]);
//                }
//            }
//        }
//        if(count($list)>0){
//            //$this->sendnotify($list);
//            $this->createMessage($list);
//            return false;
//        }
    }
    public function sendnotify($list){

        if(count($list)>0) {
            $title = $list[0]['title'];
            $text = '';
            for($i=0;$i<=count($list)-1;$i++){
                $order = $list[$i]['order_no'];
                $text = $text.$order." ".$list[$i]['req_date']."\r\n";
            }

            $message = $title."\r\n".$text;

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

            $title = $list[0]['title'];
            $text = '';
            for($i=0;$i<=count($list)-1;$i++){
                $order = $list[$i]['order_no'];
                $text = $text.$order." ".date('d/m/Y',strtotime($list[$i]['req_date'])).":";
            }

            $message = $title."\r\n".":".$text;

            $model = \backend\models\Message::find()->where(['detail_ext'=>$message])->one();
            if($model){return false;}

            $model = new \backend\models\Message();
            $model->title = $title;
            $model->message_type = 0;
          //  $model->detail = $message;
            $model->detail_ext = $message;
            $model->status = 0;
            $model->save(false);
        }
    }
    public function actionFindjob(){

        $type = Yii::$app->request->post('type');

        $list = [];
        if($type){
            if($type == '(0)'){
                $sql = "SELECT t1.*,t2.username FROM `order` as t1 inner join `user` as t2 on t2.id = t1.order_admin ";
            }else{
                $sql = "SELECT t1.*,t2.username FROM `order` as t1 inner join `user` as t2 on t2.id = t1.order_admin where t1.order_status in ".$type;
            }

            $model = Yii::$app->db->createCommand($sql)->queryAll();

            if($model){
                for($i=0;$i<=count($model)-1;$i++){
                    array_push($list,[
                       'id'=>$model[$i]['id'],
                       'order_no'=>$model[$i]['order_no'],
                       'appointment_date'=>$model[$i]['appointment_date'],
                       'order_type'=>$model[$i]['order_type'],
                       'username'=>$model[$i]['username'],
                       'order_status'=>\backend\helpers\Orderstatus::getTypeById($model[$i]['order_status'],$model[$i]['order_type']),
                       'customer_name'=>$model[$i]['customer_name'],
                    ]);
                }
                return Json::encode($list);
            }else{
                return Json::encode($list);
            }
        }
        return Json::encode($list);
    }
}
