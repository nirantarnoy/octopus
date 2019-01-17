<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;


$this->title = 'งานติดตั้ง-คิววัดหน้างาน';
?>

<div class="x_panel">
    <div class="x_title">
        <h3><i class="fa fa-bar-chart-o"></i> <?=$this->title?> <small></small></h3>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-lg-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'emptyCell'=>'-',
                    'layout'=>'{items}{summary}{pager}',
                    'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
                    'showOnEmpty'=>true,
                    'tableOptions' => ['class' => 'table table-hover'],
                    'emptyText' => '<br/><div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        [
                            'attribute' => 'appointment_date',
                            'format' => 'raw',
                            'value' => function($data){
                                return Yii::$app->formatter->asDate($data->appointment_date, 'php:d/m/Y');
                            },
                            'filter'=> DatePicker::widget([
                                    'model'=> $searchModel,
                                    'attribute' => 'appointment_date',
                                'clientOptions' => [
                                        'autoclose'=>true,
                                         'format'=>'yyyy/mm/dd'
                                ]
                            ])
                           ],
                        'order_no',
                        'customer_name',
                        'phone',
                        'delivery_name',
                        [
                            'attribute' => 'order_type',
                            'value'=>function($data){
                                return \backend\helpers\OrderType::getTypeById($data->order_type);
                            },
                            'filter'=>ArrayHelper::map(\backend\helpers\OrderType::asArrayObject(), 'id', 'name'),
                        ],



                        [
                            'attribute' => 'order_status',
                            'format' => 'raw',
                            'value'=>function($data){
                                return "<div class='label label-warning'>".\backend\helpers\Orderstatus::getTypeById($data->order_status,$data->order_type)."</div>";

                            },
                            'filter'=>ArrayHelper::map(\backend\helpers\Orderstatus::asArrayObject(1), 'id', 'name'),
                        ],
                        [
                            'attribute' => 'order_admin',
                            'value'=>function($data){
                                return \backend\models\User::findName($data->order_admin);
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

//            [
//                    'class' => 'yii\grid\ActionColumn',
//                    'options'=>['style'=>'width:120px;'],
//                    'buttonOptions'=>['class'=>'btn btn-default'],
//                    'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {print} {update} {delete} </div>',
//            ],

                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    <div class="btn btn-info"><i class="fa fa-print"></i> พิมพ์</div>
                </div>
            </div>
        </div>
    </div>
</div>

