<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ใบสั่งผลิต');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-cubes"></i> <?=$this->title?> <small></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'เปิดใบสั่งผลิต'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'order_no',
            [
                'attribute' => 'order_type',
                'value'=>function($data){
                   return \backend\helpers\OrderType::getTypeById($data->order_type);
                }
            ],
            'order_admin',

            'customer_name',
            [
                'attribute' => 'order_status',
                'value'=>function($data){
                    return $data->order_status;
                }
            ],
            //'customer_type',
            //'contact_name',
            //'contact_info',
            //'payment_type',
            //'delivery_type',
            //'delivery_name',
            //'order_status',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>