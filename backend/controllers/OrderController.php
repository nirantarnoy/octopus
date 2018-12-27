<?php

namespace backend\controllers;

use common\models\OrderFile;
use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Modelfile;
use yii\web\UploadedFile;
use yii\imagine\Image;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
                },
                'rules'=>[
//                    [
//                        'allow'=>true,
//                        'actions'=>['index','create','update','delete','view'],
//                        'roles'=>['@'],
//                    ]
                    [
                        'allow'=>true,
                        'roles'=>['@'],
                        'matchCallback'=>function($rule,$action){
                            $currentRoute = Yii::$app->controller->getRoute();
                            if(Yii::$app->user->can($currentRoute)){
                                return true;
                            }
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $model = \backend\helpers\Orderstatus::asArrayObject(1);
//        for($i=0;$i<=count($model)-1;$i++){
//            $id = $model[$i]['id'];
//            $name = $model[$i]['name'];
//            echo "<option value='" . $id . "'>$name</option>";
//        }
//        return;
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $orderfile = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>1])->all();
        $orderimage = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>2])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'orderfile' => $orderfile,
            'orderimage' => $orderimage,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $modelfile = new Modelfile();

        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {
           // echo $model->order_status;return;
            $uploadfile = UploadedFile::getInstances($modelfile,'file');
            $uploadimage = UploadedFile::getInstances($modelfile,'file_photo');
            $model->order_admin = Yii::$app->user->id;

            if($model->save()){
                $this->updateorderstatus($model->id,$model->order_status);
                if(!empty($uploadfile)){
                    foreach($uploadfile as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/files/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 1; // 1 = ไฟล
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){


                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        Image::thumbnail(Yii::getAlias('@backend') .'/web/uploads/images/'.$file, 100, 70)
                            ->rotate(0)
                            ->save(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$file, ['jpeg_quality' => 100]);


                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }


                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelfile' => $modelfile,
            'runno'=>$model->getLastNo(1),
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelpic = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>2])->all();
        $modelfile = new Modelfile();
        $orderfile = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>1])->all();
        $orderimage = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>2])->all();
        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {

            $uploadfile = UploadedFile::getInstances($modelfile,'file');
            $uploadimage = UploadedFile::getInstances($modelfile,'file_photo');


            if($model->save()){
                $this->updateorderstatus($id,$model->order_status);
                if(!empty($uploadfile)){
                    foreach($uploadfile as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/files/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 1; // 1 = ไฟล
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }

                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelfile' => $modelfile,
            'orderfile' => $orderfile,
            'orderimage' => $orderimage,
            'modelpic' => $modelpic,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){

            $modelfile = \common\models\OrderFile::find()->where(['order_id'=>$id])->all();
            if($modelfile){
                foreach ($modelfile as $val){
                    if($val->file_type == 1){
                        if(file_exists(Yii::getAlias('@backend') .'/web/uploads/files/'.$val->name)){
                            unlink(Yii::getAlias('@backend') .'/web/uploads/files/'.$val->name);
                        }

                    }else{

                        if(file_exists(Yii::getAlias('@backend') .'/web/uploads/images/'.$val->name)){
                            unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$val->name);
                        }
                        if(file_exists(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$val->name)){
                            unlink(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$val->name);
                        }
                    }
                }
                \backend\models\Orderstatus::deleteAll(['order_id'=>$id]);
            }


            $session = Yii::$app->session;
            $session->setFlash('msg','ลบรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionDeleteimage(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("pic_id");
        if($picid){
            $model = \common\models\OrderFile::find()->where(['id'=>$picid])->one();
            if($model){
                unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$model->name);
                \common\models\OrderFile::deleteAll(['id'=>$picid]);
            }

            return true;
        }
    }
    public function actionDeletefile(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("file_id");
        if($picid){
            $model = \common\models\OrderFile::find()->where(['id'=>$picid])->one();
            if($model){
                unlink(Yii::getAlias('@backend') .'/web/uploads/files/'.$model->name);
                \common\models\OrderFile::deleteAll(['id'=>$picid]);
            }

            return true;
        }
    }
    public function actionShowstatus($id){
        $model = \backend\helpers\Orderstatus::asArrayObject($id);

        if (count($model) > 0) {
            for($i=0;$i<=count($model)-1;$i++) {

                $id = $model[$i]['id'];
                $name = $model[$i]['name'];
                echo "<option value='" . $id . "'>$name</option>";

            }
        } else {
            echo "<option>เลือกประเภท</option>";
        }
    }
    public function actionPrint(){
        $order_id = Yii::$app->request->post('id');
        $papersize = Yii::$app->request->post('paper_size');
        //$papersize = 1;

        $model = \backend\models\Order::find()->where(['id'=>$order_id])->one();
        if($model){
            $modelpic = \common\models\OrderFile::find()->where(['file_type'=>2,'order_id'=>$model->id])->all();
            $pdf = new Pdf([

                //'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                //  'format' => [150,236], //manaul
                'mode'=> 's',
                'format' => $papersize ==1? Pdf::FORMAT_A4:[150,236],
                'orientation' => $papersize ==1?Pdf::ORIENT_PORTRAIT:Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_print',[
                    'model'=>$model,
                    'modelpic'=>$modelpic,
                ]),
                //'content' => "nira",
                //'defaultFont' => '@backend/web/fonts/config.php',
                'cssFile' => '@backend/web/css/pdf.css',
                //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                'options' => [
                    'title' => 'รายงานระหัสินค้า',
                    'subject' => '',
                    'showImageErrors'=>true,
                ],
                'methods' => [
                    //  'SetHeader' => ['รายงานรหัสสินค้า||Generated On: ' . date("r")],
                    //  'SetFooter' => ['|Page {PAGENO}|'],
                    //'SetFooter'=>'niran',
                ],

            ]);
            //return $this->redirect(['genbill']);
            return $pdf->render();
        }

    }
    public function actionDeletepic(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("pic_id");
        if($picid){
            $model = \common\models\OrderFile::find()->where(['id'=>$picid])->one();
            if($model){

                if(\common\models\OrderFile::deleteAll(['id'=>$picid])){
                    unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$model->name);
                    unlink(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$model->name);
                }
            }

            return true;
        }
    }
   public function updateorderstatus($id,$status){
        if($id){
            $modelstatus = \backend\models\Orderstatus::find()->where(['order_id'=>$id,'status'=>$status])->one();
            if($modelstatus){
                $modelstatus->status = $status;
                $modelstatus->note = "";
                $modelstatus->save(false);
            }else{
                $model = new \backend\models\Orderstatus();
                $model->order_id = $id;
                $model->status = $status;
                $model->note = "";
                $model->save(false);
            }
        }
   }
    public function actionGetrunno(){
        $type = Yii::$app->request->post('order_type');
        $runno = '';
        if($type){
            $runno = \backend\models\Order::getLastNo($type);
        }
        return $runno;
    }
    public function actionUpdatestatus(){
        $id = Yii::$app->request->post('id');
        $status1 = Yii::$app->request->post('status1');
        $status2 = Yii::$app->request->post('status1');
        $status = $status1 == ""?$status2:$status1;
        if($id){
            $modelorder = \backend\models\Order::find()->where(['id'=>$id])->one();
            if($modelorder){
                $modelorder->order_status = $status;
                if($modelorder->save(false)){
                    $modelstatus = \backend\models\Orderstatus::find()->where(['order_id'=>$id,'status'=>$status])->one();
                    if($modelstatus){
                        $modelstatus->status = $status;
                        $modelstatus->note = "";
                        $modelstatus->save(false);
                    }else{
                        $model = new \backend\models\Orderstatus();
                        $model->order_id = $id;
                        $model->status = $status;
                        $model->note = "";
                        $model->save(false);
                    }
                }
                $session = Yii::$app->session;
                $session->setFlash('msg',' ทำรายการเรียบร้อย');
                return $this->redirect(['index']);
            }

        }
    }
    public function actionFindtype(){
        $id = Yii::$app->request->post("id");
        if($id){
            $model = \backend\models\Order::find()->where(['id'=>$id])->one();
            if($model){
                return $model->order_type;
            }else{
                return 0;
            }
        }
    }

}
