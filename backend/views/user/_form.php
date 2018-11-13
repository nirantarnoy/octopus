<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use toxor88\switchery\Switchery;
use backend\assets\ICheckAsset;

ICheckAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);
?>

<div class="user-form">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-user"></i> <?=$this->title?> <small></small></h3>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?php //echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'group_id')->widget(Select2::className(),[
                    'data'=>ArrayHelper::map(\backend\models\Usergroup::find()->all(),'id','name')
            ]) ?>

            <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label() ?>

            <div class="row" style="background-color: #CCCCCC">
                <div class="col-lg-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สิทธิ์ใช้งาน
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <?= $form->field($model, 'roles')->checkboxList($model->getAllRoles())->label(false) ?>
                    </div>
                </div>
            </div>


            <div class="ln_solid"></div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
