<?php

/* @var $this yii\web\View */

$this->title = 'octopus';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" style="height: 60px;font-size: 24px;" placeholder="กรอกเลขที่ QT และ (อีเมล หรือ เบอรโทร)">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="button">ตรวจสอบสถานะ</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="body-content">-->
<!---->
<!--        <div class="row">-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
    <div class="result">
       <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>เลขที่ใบสั่งงาน <small>D622</small></h1>
            </div>
        </div>
    </div>

    <?php
    $wizard_config = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => 'Step 1',
                'icon' => 'glyphicon glyphicon-cloud-download',
                'content' => '<h3>ขั้นตอนที่ 1 เปิดใบสั่งงาน</h3>เปิดใบสั่งงาน',
                'buttons' => [
                    'next' => [
                        'title' => 'Forward',
                        'options' => [
                            'class' => 'disabled'
                        ],
                    ],
                ],
            ],
            2 => [
                'title' => 'Step 2',
                'icon' => 'glyphicon glyphicon-cloud-upload',
                'content' => '<h3>Step 2</h3>This is step 2',
                'skippable' => true,
                'buttons'=>null,
            ],
            3 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            4 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            5 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            6 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            7 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            8 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            9 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
            10 => [
                'title' => 'Step 3',
                'icon' => 'glyphicon glyphicon-transfer',
                'content' => '<h3>Step 3</h3>This is step 3',
            ],
        ],
        'complete_content' => "You are done!", // Optional final screen
        'start_step' => 2, // Optional, start with a specific step


    ];
    ?>

    <?php //echo \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>


        <div class="container-x">
            <ul class="progressbar">
                <?php for($i=1;$i<=count(\backend\helpers\Orderstatus::asArray(1));$i++):?>
                <?php
                    $isactive = '';
                    if($i<=4){
                        $isactive = 'active';
                    }
                ?>

                <li class="<?=$isactive?>"><?=\backend\helpers\Orderstatus::asArray(1)[$i]?></li>
                <?php endfor;?>
<!--                <li class="active">step 2</li>-->
<!--                <li>step 3</li>-->
<!--                <li>step 4</li>-->
<!--                <li>step 5</li>-->
<!--                <li>step 6</li>-->
<!--                <li>step 7</li>-->
<!--                <li>step 8</li>-->
<!--                <li>step 9</li>-->
<!--                <li>step 10</li>-->
<!--                <li>step 11</li>-->

            </ul>
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
?>
