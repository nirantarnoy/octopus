<?php

/* @var $this yii\web\View */

$this->title = 'octopus';
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\spinner\Spinner;

?>
<div class="site-index">

    <div class="jumbotron">
        <div class="alert alert-success" role="alert" style="text-align: left;">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            กรอกเลขที่ใบเสนอราคาและอีเมลหรือเบอร์โทรเพื่อตรวจสอบสถานะ
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="form-search" action="<?=Url::to(['site/find'],true)?>">
                    <div class="row">
                        <div class="col-lg-6">

                                <input type="text" class="form-control quo-fill" style="height: 60px;font-size: 24px;" placeholder="เลขที่ใบเสนอราคา" required>

                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control confirm-fill" style="height: 60px;font-size: 24px;" placeholder="อีเมล หรือ เบอร์โทร" required>
                                <span class="input-group-btn">
<!--                        <input type="submit" class="btn btn-info" value="ตกลง">-->
                                <input type="button" id="btn-submit" class="btn btn-info" value="ตกลง" />
                                </span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <br>
        <div class="alert alert-danger alert-not-fill" style="display: none" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span class="error-text"></span>
        </div>
        <div class="alert alert-danger alert-not-found" style="display: none" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            ไม่พบข้อมูลที่ต้องการค้นหา กรุณาลองใหม่อีกครั้ง
        </div>
        <div class="row spin-wait" style="display: none;">
            <div class="col-lg-12">
                <?php echo '<div class="border border-secondary p-3 rounded">';
                echo Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue', 'caption' => 'กำลังค้นหาข้อมูล &hellip;']);
                echo '<div class="clearfix"></div>';
                echo '</div>';
                ?>
            </div>
        </div>
        <div class="result" style="display: none">

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>เลขที่ใบสั่งงาน <small class="order_text">D622</small></h1>
                    </div>
                </div>
            </div>

            <div class="container-x">
                <ul class="progressbar">
                    <?php for($i=1;$i<=count(\backend\helpers\Orderstatus::asArray(1));$i++):?>
                        <?php
                        $isactive = '';
                        if($i<=4){
                            $isactive = 'active';
                        }
                        ?>
                        <?php if($i >=3 && $i <=4):?>

                        <?php else:?>
                            <li class="step_no"><?=\backend\helpers\Orderstatus::asArray(1)[$i]?></li>
                        <?php endif;?>

                    <?php endfor;?>
                </ul>
            </div>
        </div>

        <div class="result-vertical" style="display: none">

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>เลขที่ใบสั่งงาน <small class="order_text">D622</small></h1>
                    </div>
                </div>
            </div>

            <div class="container-x">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="progress-indicator">
                    <?php $i=0;?>
                    <?php for($i=1;$i<=count(\backend\helpers\Orderstatus::asArray(1));$i++):?>
                        <?php
                        $isactive = '';
                        $lineactive = 'failed';
                        if($i<=4){
                            $isactive = 'active';
                            $lineactive = 'done';
                        }
                        ?>
                        <?php if($i >=3 && $i <=4):?>
                        <?php $i+=1;?>
                        <?php else:?>
                            <div class="step <?=$isactive?>">
                                <div class="circle"><?=$i?></div>
                                <div class="text"><?=\backend\helpers\Orderstatus::asArray(1)[$i]?></div>
                            </div>

                        <?php endif;?>

                    <?php endfor;?>



<!--                                <div class="step active">-->
<!--                                    <div class="circle">2</div>-->
<!--                                    <div class="text">-->
<!--                                        Fill Out Listing-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="step">-->
<!--                                    <div class="circle">3</div>-->
<!--                                    <div class="text">Bulk Options</div>-->
<!--                                </div>-->
<!--                                <div class="step">-->
<!--                                    <div class="circle">4</div>-->
<!--                                    <div class="text">More Options</div>-->
<!--                                </div>-->
                            </div>

                        </div>

                    </div>

            </div>
        </div>

    </div>



</div>
<div id="billxModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <form id="form-modal-bill" action="<?=Url::to(['sale/printbill'],true)?>" method="post" target="_blank">
                    <br>
                    <input type="hidden" name="id" value="" class="sale_line_id">
                    <div class="row">
                        <div class="col-lg-12">
                            ขนาดกระดาษที่ต้องการ
                            <select name="paper_size" id="paper-size">
                                <option value="1">A4</option>
                                <option value="2">A5</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-print-bill">พิมพ์</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>

    </div>
</div>
<?php
$css =<<<CSS
   .container-x{
    width: 100%;
   }
   .progressbar{
     counter-reset: step;
     display: table;
     table-layout: fixed;
     width: 100%;
     margin: 0 auto;
   }
   .progressbar li {
     list-style-type: none;
     display: table-cell;
     width: 9%;
     float: left;
     position: relative;
     text-align: center;
   }
   .progressbar li:before{
    content: counter(step);
    counter-increment: step;
    width: 50px;
    height: 50px;
    line-height: 50px;
    border: 2px solid #ddd;
    display: block;
    text-align: center;
    margin: 0 auto 10px auto;
    border-radius: 50%;
    background-color: white;
   }
   .progressbar li:after{
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: #ddd;
    top: 25px;
    left: -50%;
    z-index: -1;
   }
   .progressbar li:first-child:after{
    content: none;
   }
   .progressbar li.active{
     color: orange;
   }
   .progressbar li.active:before{
    border-color: orange;
   }
   .progressbar li.active + li:after{
     background-color: orange;
   }
   
   
   
.btn.btn-green {
  background-color: #80b241;
  color: #ffffff; }
  .btn.btn-green:hover {
    background-color: #88bc47; }

.btn.btn-gray-1 {
  background-color: #595959;
  color: #e7e5e1; }
  .btn.btn-gray-1:hover {
    background-color: #666666; }

.label.label-green {
  background-color: #80b241;
  color: #242424; }

.label.label-gray-1 {
  background-color: #595959;
  color: #ffffff; }

.btn.btn-green {
  background-color: #80b241;
  color: #ffffff; }
  .btn.btn-green:hover {
    background-color: #88bc47; }

.btn.btn-gray-1 {
  background-color: #595959;
  color: #e7e5e1; }
  .btn.btn-gray-1:hover {
    background-color: #666666; }

.label.label-green {
  background-color: #80b241;
  color: #242424; }

.label.label-gray-1 {
  background-color: #595959;
  color: #ffffff; }

.progress-indicator {
  margin-bottom: 50px;
  margin-top: 75px; }
    .progress-indicator .step {
    margin-top: 30px;
    content: "";
    display: table;
    clear: both;
    position: relative; }
    .progress-indicator .step:before {
      content: "";
      position: absolute;
      z-index: 1;
      margin-top: 50px;
      left: 25px;
      border: 1px solid #ADABA6;
      background-color: #80b241;
      height: 65%; }
      
     .progress-indicator .step.active:after {
     
       content: "";
      position: absolute;
      z-index: 1;
      margin-top: 50px;
      left: 25px;
      border: 1px solid orange;
      background-color: orange;
      height: 65%; }
      
    .progress-indicator .step:first-child {
      margin-top: 0; }
    .progress-indicator .step:last-child:before {
      display: none; }
    .progress-indicator .step.active div {
      color: orange; 
      }
      .progress-indicator .step.active div.circle {
        border-color: orange; }
      .progress-indicator .step.active div a {
        color: orange; }
    .progress-indicator .step.complete div {
      color: #80b241; }
      .progress-indicator .step.complete div.circle {
        border-color: #80b241; }
        .progress-indicator .step.complete div.circle.filled {
          background-color: #80b241;
          color: #ffffff; }
    .progress-indicator .step div {
      color: #ADABA6;
      display: table-cell;
      float: left;
      padding-top: 2px;
      font-size: 16px;
      font-weight: bold;
      vertical-align: middle; }
      .progress-indicator .step div.circle {
        height: 50px;
        width: 50px;
        text-align: center;
        padding-top: 10px;
        border: 2px solid #ADABA6;
        border-radius: 50%; }
      .progress-indicator .step div.text {
        padding-left: 10px;
        padding-top: 10px; }
        .progress-indicator .step div.text ul {
          margin: 0;
          margin-top: 15px;
          padding: 0;
          list-style-type: none; }
          .progress-indicator .step div.text ul li a {
            display: block;
            margin-top: 10px; }
            .progress-indicator .step div.text ul li a:first-child {
              margin-top: 0; }

/*.category-selector {*/
  /*margin-top: 30px; }*/
  /*.category-selector .header {*/
    /*border-bottom: 2px solid #80b241; }*/
    /*.category-selector .header:before, .category-selector .header:after {*/
      /*content: " ";*/
      /*display: table; }*/
    /*.category-selector .header:after {*/
      /*clear: both; }*/
  /*.category-selector .section-container:before, .category-selector .section-container:after {*/
    /*content: " ";*/
    /*display: table; }*/
  /*.category-selector .section-container:after {*/
    /*clear: both; }*/
  /*.category-selector .section-container .section {*/
    /*float: left;*/
    /*height: 400px;*/
    /*min-width: 150px;*/
    /*overflow-y: scroll; }*/
    /*.category-selector .section-container .section .item {*/
      /*border-bottom: 1px solid #80b241;*/
      /*cursor: pointer;*/
      /*padding: 5px 10px 5px 5px; }*/
      /*.category-selector .section-container .section .item:last-child {*/
        /*border: 0; }*/
      /*.category-selector .section-container .section .item.active {*/
        /*background-color: #80b241;*/
        /*color: #ffffff; }*/

    /**/
    /**/


CSS;
$this->registerCss($css);

$url_to_find = Url::to(['find'],true);

$js =<<<JS
  $(function() {
     $("#btn-submit").click(function(){
         $(".result").hide();
         if($(".quo-fill").val()==''){
             $(".alert-not-fill").show();
             $(".alert-not-found").hide();
             $(".error-text").text("กรุณากรอกเลขที่ใบเสนอราคา");
             $(".quo-fill").focus();
             return;
         }else if($(".confirm-fill").val()==''){
             $(".alert-not-fill").show();
             $(".alert-not-found").hide();
              $(".error-text").text("กรุณากรอกอีเมลหรือเบอร์โทรศัพท์");
             $(".confirm-fill").focus();
             return;
         }else{
             $(".alert-not-fill").hide();
              $(".alert-not-found").hide();
             $(".spin-wait").show();
             $.ajax({
           'type': 'post',
           'dataType': 'json',
           'url': "$url_to_find",
           'data': {'quotation_no': $(".quo-fill").val(),'contact':$(".confirm-fill").val()},
           'success': function(data){
               if(data.length >0){
                    $(".alert-not-found").hide();
                   // alert(data[0]['order_status']);
                    setTimeout(function(){
                       
                         if ($(window).width() < 700){
                              $(".result").hide();
                              $(".result-vertical").show();
                         }else{
                              $(".result").show();
                              $(".result-vertical").hide();
                         }
                        $(".order_text").text(data[0]['order_no']);
                        $(".spin-wait").hide(); 
                        }, 2000);
                        var i = 0;
                        var looporder = 0;
                        
                        if(data[0]['order_status'] == 3){
                            looporder = data[0]['order_status']-1;
                        }
                       
                         if(data[0]['order_status'] >= 4){
                            looporder = data[0]['order_status']-2;
                        }else{
                             looporder = data[0]['order_status'];
                        }
                        
                       if ($(window).width() > 700){
                        
                        $(".progressbar >li").each(function(){
                            i+=1;
                            // for(var x =1;x <= data[0]['order_status'];x++){
                            //     if(x == 3 || x ==4){
                            //         continue;
                            //     }
                            //     if(i == 1){
                            //         $(this).addClass("active");
                            //         continue;
                            //     }else if(i==2 ){
                            //         $(this).text(data[0]['confirm_status']);
                            //         $(this).addClass("active");
                            //         continue;
                            //     }else if(i >= x){
                            //       continue;  
                            //     }else{
                            //         $(this).addClass("active");
                            //         continue;
                            //     }
                            // }
                            
                            if(i <= looporder){
                               //console.log(i);
                                //alert("Ok");
                                if(i == 1){
                                     $(this).addClass("active");
                                }
                                else if(i == 2){
                                    $(this).text(data[0]['confirm_status']);
                                    $(this).addClass("active");
                  
                                }else if(i==3){
                                    if(data[0]['order_status'] > 4){
                                        $(this).addClass("active");
                                    }
                                }else{
                                    $(this).addClass("active");
                                }
                                
                              
                            }else{
                                return false;
                            }
                        });
                       }
                    
                    //$(".")
               }else{
                    setTimeout(function(){ $(".alert-not-found").show();;$(".spin-wait").hide(); }, 2000);
                    $(".result").hide();
               }
           }
         });
             
         }
         
         
         
         //$("#form-search").submit();
     });
  });
JS;
$this->registerJs($js);

?>
