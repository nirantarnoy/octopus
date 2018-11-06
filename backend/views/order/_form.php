<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
$cur_type = 0;

?>

<div class="order-form">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-shopping-cart"></i> <?=$this->title?> <small></small></h3>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'order_type')->widget(Select2::className(),[
                'data'=>ArrayHelper::map(\backend\helpers\OrderType::asArrayObject(),'id','name'),
                'options'=>[
                    'placeholder'=>'เลือกประเภท',
                    'onchange'=>'
                       $.post("'.Url::to(['order/showstatus'],true).'"+"&id="+$(this).val(),function(data){
                                          $("select#orderstatus").html(data);
                                        
                       });
                    '
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'order_no')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->isNewRecord?$runno:$model->order_no]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'order_admin')->textInput(['readonly'=>'readonly']) ?>
        </div>

    </div>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'customer_type')->widget(Select2::className(),[
                        'data'=>ArrayHelper::map(\backend\helpers\CustomerType::asArrayObject(),'id','name'),
                        'options'=>[
                            'placeholder'=>'เลือกประเภท'
                        ]
                    ]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'quotation_no')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'contact_info')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'appointment_date')->widget(DateTimePicker::className(),[
                        'value' => date('d-m-Y'),

                ]) ?>
            </div>
        </div>


    <div class="row">
<!--        <div class="col-lg-4">-->
            <?php //echo $form->field($model, 'payment_type')->widget(Select2::className(),[
//                'data'=>ArrayHelper::map(\backend\helpers\PaymentType::asArrayObject(),'id','name'),
//                'options'=>[
//                    'placeholder'=>'เลือกประเภท'
//                ]
//            ]) ?>
<!--        </div>-->

        <div class="col-lg-4">
            <?= $form->field($model, 'delivery_type')->widget(Select2::className(),[
                'data'=>ArrayHelper::map(\backend\models\Delivertype::find()->all(),'id','name'),
                'options'=>[
                    'placeholder'=>'เลือกประเภท'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'delivery_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'order_status')->widget(Select2::className(),[
                'data'=>ArrayHelper::map(\backend\helpers\Orderstatus::asArrayObject(1),'id','name'),
                'options'=>[
                        'id'=>'orderstatus',
                    'placeholder'=>'เลือกประเภท'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">

    </div>
            <div class="row">
                <div class="col-lg-6">
                    <?php echo '<label class="control-label">แนบไฟล์งาน</label>';
                    echo FileInput::widget([
                        'model' => $modelfile,
                        'attribute' => 'file[]',
                        'options' => ['multiple' => true]
                    ]);
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php echo '<label class="control-label">แนบไฟล์รูปงาน</label>';
                    echo FileInput::widget([
                        'model' => $modelfile,
                        'attribute' => 'file_photo[]',
                        'options' => [
                                'multiple' => true ,
                                'accept' => 'image/*',
                        ]
                    ]);
                    ?>
                </div>
            </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
