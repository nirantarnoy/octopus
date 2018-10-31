<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsergroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'กลุ่มผู้ใช้');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-index">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-users"></i> <?=$this->title?> <small></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'สร้างกลุ่มผู้ใช้งาน'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'description',
            'status',
            'created_at',
            //'updated_at',
            //'created_by',
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