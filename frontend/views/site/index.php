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
                        $(".result").show();
                        $(".order_text").text(data[0]['order_no']);
                        $(".spin-wait").hide(); 
                        }, 2000);
                        var i = 0;
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
                            if(i <= data[0]['order_status']){
                               console.log(i);
                                //alert("Ok");
                                if(i == 1){
                                     $(this).addClass("active");
                                }
                                else if(i == 2){
                                         $(this).text(data[0]['confirm_status']);
                                         $(this).addClass("active");
                  
                                }else if(i == 3 && data[0]['order_status'] >4){
                                    $(this).addClass("active");
                                }
                              
                            }else{
                                return false;
                            }
                        });
                    
                    
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
