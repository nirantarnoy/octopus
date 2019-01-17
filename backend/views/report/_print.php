<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 06/11/2018
 * Time: 09:33:20
 */

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<table width="100%" class="table table_bordered">
    
</table>

<?php foreach ($modelpic as $value):?>
    <img src="<?= \yii\helpers\Url::to('@web/uploads/images/'.$value->name, true) ?>" width="100%" alt="logo" />
<?php endforeach;?>

</body>
</html>

