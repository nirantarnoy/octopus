<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DelivertypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ประเภทการจัดส่ง');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivertype-index">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-truck"></i> <?=$this->title?> <small></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'สร้างประเภทจัดส่ง'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'description',
            [
                'attribute'=>'status',
                'contentOptions' => ['style' => 'vertical-align: middle'],
                'format' => 'html',
                'value'=>function($data){
                    return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                }
            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
