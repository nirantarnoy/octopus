<?php

/* @var $this yii\web\View */

$this->title = 'octopus';
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\spinner\Spinner;

?>
<div class="site-index">

    <div class="jumbotron">

        <div class="row">
            <div class="col-lg-12">
                <form id="form-search" action="<?=Url::to(['site/find'],true)?>">
                <div class="input-group">
                    <input type="text" class="form-control quo-fill" style="height: 60px;font-size: 24px;" placeholder="กรอกเลขที่ QT และ (อีเมล หรือ เบอรโทร)" required>
                    <span class="input-group-btn">
<!--                        <input type="submit" class="btn btn-info" value="ตกลง">-->
                        <input type="button" id="btn-submit" class="btn btn-info" value="ok" />
                    </span>
                </div>
                </form>
            </div>
        </div>
        <br>
        <div class="alert alert-danger alert-not-fill" style="display: none" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            กรุณากรอกข้อมูลใบเสนอราคา
        </div>
        <div class="alert alert-danger alert-not-found" style="display: none" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            ไม่พบข้อมูลที่ต้องการค้นหา กรุณาลองใหม่อีกครั้ง
        </div>
        <div class="row" class="spin-wait" style="display: none;">
            <div class="col-lg-12">
                <?php echo '<div class="border border-secondary p-3 rounded">';
                echo Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue']);
                echo '<div class="clearfix"></div>';
                echo '</div>';
                ?>
            </div>
        </div>
        <div class="result" style="display: none">

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>เลขที่ใบสั่งงาน <small>D622</small></h1>
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
                            <li class="<?=$isactive?>"><?=\backend\helpers\Orderstatus::asArray(1)[$i]?></li>
                        <?php endif;?>

                    <?php endfor;?>
                </ul>
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
         if($(".quo-fill").val()==''){
             $(".alert-not-fill").show();
             $(".alert-not-found").hide();
             return;
         }else{
             $(".alert-not-fill").hide();
             $.ajax({
           'type': 'post',
           'dataType': 'html',
           'url': "$url_to_find",
           'data': {'quotation_no': $(".quo-fill").val()},
           'success': function(data){
               if(data == "1"){
                    $(".alert-not-found").hide();
                    $(".result").show();
               }else{
                    $(".alert-not-found").show();
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
