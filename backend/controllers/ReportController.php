<?php

namespace backend\controllers;

use Yii;
use yii\imagine\Image;
use kartik\mpdf\Pdf;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionWorkque(){

        $searchModel = new \backend\models\OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dates = Yii::$app->request->queryParams;
        if(!empty($dates['OrderSearch'])){
            $dataProvider->query->andFilterWhere(['DATE(appointment_date)'=>$dates['OrderSearch']['appointment_date']])
                               ->andFilterWhere(['like','phone',$dates['OrderSearch']['phone']]);
        }


        return $this->render('workque', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
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
}
