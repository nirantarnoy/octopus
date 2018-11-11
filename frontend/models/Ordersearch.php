<?php
namespace frontend\models;

use yii\base\Model;

class Ordersearch extends Model{
    public $quotation_no;

    public function rules(){
        return[
            [['quotation_no'],'required'],
            [['quotation_no'],'string'],
        ];
    }
}
