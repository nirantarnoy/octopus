<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Order extends \common\models\Order
{
    public function behaviors()
    {
        return [
            'timestampcdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
                ],
                'value'=> time(),
            ],
            'timestampudate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
                ],
                'value'=> time(),
            ],
//            'timestampcby'=>[
//                'class'=> \yii\behaviors\AttributeBehavior::className(),
//                'attributes'=>[
//                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_by',
//                ],
//                'value'=> Yii::$app->user->identity->id,
//            ],
//            'timestamuby'=>[
//                'class'=> \yii\behaviors\AttributeBehavior::className(),
//                'attributes'=>[
//                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_by',
//                ],
//                'value'=> Yii::$app->user->identity->id,
//            ],
            'timestampupdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_at',
                ],
                'value'=> time(),
            ],
        ];
    }

//    public function findBankinfo($id){
//        $model = Bank::find()->where(['id'=>$id])->one();
//        return count($model)>0?$model:null;
//    }
//    public function getLogo($id){
//        $model = Bank::find()->where(['id'=>$id])->one();
//        return count($model)>0?$model->logo:'';
//    }
//    public function getBankname($id){
//        $model = Bank::find()->where(['id'=>$id])->one();
//        return count($model)>0?$model->name:'';
//    }
//    public function getBankshortname($id){
//        $model = Bank::find()->where(['id'=>$id])->one();
//        return count($model)>0?$model->short_name:'';
//    }
    public function getLastNo($trans_type){
        $model = \backend\models\Order::find()->where(['order_type'=>$trans_type])->MAX('order_no');
//        $pre = \backend\models\Sequence::find()->where(['module_id'=>$trans_type])->one();
        if($model){
            $prefix = $trans_type==1?'D':'S';// substr(date("Y"),2,2);
            $cnum = substr((string)$model,strlen($prefix),strlen($model));
            $len = strlen($cnum);
            $clen = strlen($cnum + 1);
            $loop = $len - $clen;
            for($i=1;$i<=$loop;$i++){
                $prefix.="0";
            }
            $prefix.=$cnum + 1;
            return $prefix;
        }else{
            $prefix = $trans_type==1?'D':'S';//substr(date("Y"),2,2);
            return $prefix.'0001';
        }
    }
}
