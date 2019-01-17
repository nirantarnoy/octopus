<?php

namespace backend\controllers;

use Yii;

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
}
