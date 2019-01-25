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
                    'id'=>'select_order_type',
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
            <?= $form->field($model, 'order_no')->textInput(['class'=>'form-control order_no','maxlength' => true,'readonly'=>'readonly','value'=>$model->isNewRecord?$runno:$model->order_no]) ?>
        </div>
        <div class="col-lg-4">
            <input type="hidden" name="admin_id" value="<?=Yii::$app->user->id;?>">
            <?= $form->field($model, 'admin_name')->textInput(['readonly'=>'readonly','value'=> $model->isNewRecord?\backend\models\User::findName(Yii::$app->user->id):\backend\models\User::findName($model->order_admin)])->label() ?>
        </div>

    </div>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'quotation_no')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>
                </div>
<!--                <div class="col-lg-4">-->
  <?php //echo $form->field($model, 'customer_type')->widget(Select2::className(),[
//                        'data'=>ArrayHelper::map(\backend\helpers\CustomerType::asArrayObject(),'id','name'),
//                        'options'=>[
//                            'placeholder'=>'เลือกประเภท'
//                        ]
//                   ]) ?>
<!--                </div>-->

                <div class="col-lg-4">
                    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        <div class="row">

            <div class="col-lg-4">
                <?= $form->field($model, 'contact_info')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
            <div class="row">


                <div class="col-lg-4">
                    <?= $form->field($model, 'appointment_date')->widget(DateTimePicker::className(),[
                        'value' => date('d-m-Y'),

                    ]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'delivery_type')->widget(Select2::className(),[
                        'data'=>ArrayHelper::map(\backend\models\Delivertype::find()->all(),'id','name'),
                        'options'=>[
                            'placeholder'=>'เลือกประเภท'
                        ]
                    ]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'delivery_name')->textarea(['maxlength' => true]) ?>
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
            <?= $form->field($model, 'order_status')->widget(Select2::className(),[
                'data'=>ArrayHelper::map(\backend\helpers\Orderstatus::asArrayObject($model->order_type),'id','name'),
                'options'=>[
                        'id'=>'orderstatus',
                    'placeholder'=>'เลือกประเภท'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
       <col-lg-6>

       </col-lg-6>
        <div class="col-lg-6">

                <?php if(!$model->isNewRecord): ?>
                    <div class="panel panel-body">  <div class="row">
                            <?php foreach ($modelpic as $value):?>

                                <div class="col-xs-6 col-md-3">
                                    <a href="#" class="thumbnail">
<!--                                        <img src="../../backend/web/uploads/images/--><?php //echo $value->name?><!--" alt="">-->
                                        <img src="../../backend/web/uploads/images/<?=$value->name?>" alt="">
                                    </a>
                                    <div class="btn btn-default" data-var="<?=$value->id?>" onclick="removepic($(this));">ลบ</div>
                                </div>

                                <?php //echo Html::img("../../frontend/web/img/screenshots/".$value->filename,['width'=>'10%','class'=>'thumbnail']) ?>
                            <?php endforeach;?></div>
                    </div>
                <?php endif;?>


        </div>
    </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-list">
                        <thead>
                        <th width="5%">#</th>
                        <th width="65%">รายการ</th>
                        <th width="20%">จำนวน</th>
                        <th width="10%"> - </th>
                        </thead>
                        <tbody>
                        <?php if($model->isNewRecord):?>
                        <tr>

                            <td style="vertical-align: middle">1</td>
                            <td>
                                <input type="text" name="items[]" class="form-control line_item">
                            </td>
                            <td>
                                <input type="text" name="qty[]" class="form-control line_qty">
                            </td>
                            <td>
                                <div class="btn btn-danger btn-remove" onclick="removeline($(this))"><i class="fa fa-minus"></i></div>
                            </td>
                        </tr>
                        <?php else:?>
                           <?php $i=0;?>
                           <?php if(count($orderitem)>0):?>
                           <?php foreach ($orderitem as $value):?>
                            <?php $i+=1;?>
                                <tr data-var="<?=$value->id?>">

                                    <td style="vertical-align: middle">1</td>
                                    <td>
                                        <input type="text" name="items[]" class="form-control line_item" value="<?=$value->title?>">
                                    </td>
                                    <td>
                                        <input type="text" name="qty[]" class="form-control line_qty" value="<?=$value->qty?>">
                                    </td>
                                    <td>
                                        <div class="btn btn-danger btn-remove" onclick="removeline($(this))"><i class="fa fa-minus"></i></div>
                                    </td>
                                </tr>
                           <?php endforeach;?>
                           <?php else:?>
                                <tr>

                                    <td style="vertical-align: middle">1</td>
                                    <td>
                                        <input type="text" name="items[]" class="form-control line_item">
                                    </td>
                                    <td>
                                        <input type="text" name="qty[]" class="form-control line_qty">
                                    </td>
                                    <td>
                                        <div class="btn btn-danger btn-remove" onclick="removeline($(this))"><i class="fa fa-minus"></i></div>
                                    </td>
                                </tr>
                           <?php endif;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn btn-primary btn-add"><i class="fa fa-plus"></i> เพิ่มรายการ</div>
                </div>
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
<canvas id="output"></canvas>
<?php
$url_to_del_pic = Url::to(['order/deletepic'],true);
$url_to_del_item = Url::to(['order/deleteitem'],true);
$url_to_find_runno = Url::to(['order/getrunno']);
$js =<<<JS
  $(function() {
    $(".btn-add").click(function(){
          var tr = $(".table-list tbody tr:last");
          
          if(tr.closest("tr").find(".line_item").val() == ""){return;}
          
          var linenum = 0;
          var clone = tr.clone();
          clone.find(":text").val("");
          clone.attr("data-var","");
          tr.after(clone);
          
           $(".table-list tbody tr").each(function(){
             linenum+=1;
             $(this).closest("tr").find("td:eq(0)").text(linenum);
           });
    });  
    $(".line_qty").on("keypress",function(event){
       $(this).val($(this).val().replace(/[^0-9\.]/g,""));
       if((event.which != 46 || $(this).val().indexOf(".") != -1) && (event.which <48 || event.which >57)){event.preventDefault();}
    });
    $("#select_order_type").change(function(){
       $.ajax({
           'type':'post',
           'dataType':'html',
           'url':"$url_to_find_runno",
           'data': {'order_type': $(this).val()},
           'success': function(data) {
             $(".order_no").val(data);
           }
        });
    });
    
    
    $( ".print" ).click(function() {     // evnet click capture icon
        alert();
             
              function crateimage(img, selection){     // function สำหรับจับ event imageselectend
                  var canvas = document.getElementById('output');
                  var context = canvas.getContext('2d');
                  var imageObj = new Image();
                  var imagename;
                  
                  imageObj.onload = function() {
                     canvas.width = selection.width;
                     canvas.height = selection.height;
                     // สร้าง cavans ขึ้นมาให้มตามขนาดที่ user เลือก
                     context.drawImage(imageObj, selection.x1,selection.y1,selection.width,selection.height,0,0,selection.width,selection.height);
                     var d = new Date();
                     // ส่งค่่ารูปให้กับปุ่มบันทึก
                     $(".saveimg").attr("href",canvas.toDataURL("image/png"));
                     // กำหนดชื่อไฟล์ตอน save ผมใส่ date เขาไปหลายอันจะได้ไม่ซำกัน
                     $(".saveimg").attr("download","captue"+d.getDate()+d.getDate()+d.getFullYear()+d.getHours()+d.getMilliseconds());
                  }    
                
                  imageObj.src = img.src;         
           }
 
           html2canvas($(".screen"), {     // แปลงจาก html เป็น cavans
                 
              onrendered: function(canvas) {
                 
                 var image = new Image();
                 var img = '<img id="image_edit" src="'+canvas.toDataURL("image/png")+'">';  // แปลง cavans เป็น image และสร้าง tag img html มาให้ม
                 var imgselect;
                 
                           $(".onscreen").html(img).promise().done(function(){  // ใส่รูปลงใน div class onscreen
    
    
                           
                               $(".screen").hide();
                               $(".print").hide();
                               $(".onscreen").show();
                               $(".save").show();
                           
                               imgselect = $('#image_edit').imgAreaSelect({    // init imgareaselect 
                                     handles: true,   
                                     instance: true, 
                                     show:true,                     
                                     onSelectEnd: crateimage // จับ event ด้วย function crateimage 
                           });
                           
                           
                           
                           $(".save").click(function() {  // จับ event ปุ่ม save ข้อมูล
                            
                            imgselect.cancelSelection(); // ล้างค่า img AreaSelect
                               $(".print").show();
                               $(".onscreen").hide();
                               $(".screen").show();
                               $(this).hide();
                            }); 
             });
            }
       });
    });
    
    
  });
  function removeline(e) {
     if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
         
        if(e.parent().parent().attr('data-var') == ''){
            e.parent().parent().remove();
        } 
        $.ajax({
           'type':'post',
           'dataType':'html',
           'url':"$url_to_del_item",
           'data': {'item_id':e.attr("data-var")},
           'success': function(data) {
             location.reload();
           }
        });
    } 
  }
  function removepic(e){
   // alert(e.attr("data-var"));return;
    if(confirm("ต้องการลบรูปภาพนี้ใช่หรือไม่")){
        $.ajax({
           'type':'post',
           'dataType':'html',
           'url':"$url_to_del_pic",
           'data': {'pic_id':e.attr("data-var")},
           'success': function(data) {
             location.reload();
           }
        });
    }
  }
JS;

$this->registerJs($js,static::POS_END);

?>
