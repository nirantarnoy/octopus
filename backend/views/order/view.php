<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'ใบสั่งผลิตเลขที่ '.$model->order_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบสั่งผลิต'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss('
  .borderless td, .borderless th {
    border: none;
    padding: 5px;15px;5px;35px;
  }
  .row-detail{
    font-size: 16px;
  }
');

?>
<div class="order-view">

    <p>
        <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-cubes"></i> <?=$this->title?> <small></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row row-detail">
                <div class="col-lg-4">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                            // 'id',
                            'order_admin',
                            [
                                'attribute'=>'order_type',
                                'format' => 'html',
                                'value'=>function($data){
                                    return \backend\helpers\OrderType::getTypeById($data->order_type);
                                }
                            ],
                            'order_no',
                            'customer_name',
                            [
                                'attribute'=>'customer_type',
                                'format' => 'html',
                                'value'=>function($data){
                                    return \backend\helpers\CustomerType::getTypeById($data->customer_type);
                                }
                            ],
                            'contact_name',
                            'contact_info',

                        ],
                    ]) ?>
                </div>
                <div class="col-lg-4">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [

                            [
                                'attribute'=>'payment_type',
                                'format' => 'html',
                                'value'=>function($data){
                                    return \backend\helpers\PaymentType::getTypeById($data->payment_type);
                                }
                            ],
                            [
                                'attribute'=>'delivery_type',
                                'format' => 'html',
                                'value'=>function($data){
                                    return \backend\models\DeliverType::findName($data->delivery_type);
                                }
                            ],
                            'delivery_name',
                            [
                                'attribute'=>'order_status',
                                'contentOptions' => ['style' => 'vertical-align: middle'],
                                'format' => 'html',
                                'value'=>function($data){
                                    return $data->order_status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                }
                            ],
                            [
                                'attribute'=>'created_at',
                                'format' => 'html',
                                'value'=>function($data){
                                    return date('d-m-Y',$data->created_at);
                                }
                            ],
                            [
                                'attribute'=>'updated_at',
                                'format' => 'html',
                                'value'=>function($data){
                                    return date('d-m-Y',$data->updated_at);
                                }
                            ],
                            'created_by',
                            'updated_by',
                        ],
                    ]) ?>
                </div>

            </div>

        </div>


</div>
    <div class="x_panel">
        <div class="x_title">
            <h4><i class="fa fa-list-alt"></i> เอกสารเสนอราคา<small></small></h4>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h4><i class="fa fa-file-archive-o"></i> ไฟล์แนบ<small></small></h4>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h4><i class="fa fa-image"></i> รูปงาน<small></small></h4>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        </div>
    </div>
</div>
