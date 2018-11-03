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
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>เลขที่ใบสั่งงาน <small>ABC18-000001</small></h1>
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
//                'buttons' => [
//                    'next' => [
//                        'title' => 'Forward',
//                        'options' => [
//                            'class' => 'disabled'
//                        ],
//                    ],
//                ],
            ],
            2 => [
                'title' => 'Step 2',
                'icon' => 'glyphicon glyphicon-cloud-upload',
                'content' => '<h3>Step 2</h3>This is step 2',
                'skippable' => true,
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

    <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

</div>
