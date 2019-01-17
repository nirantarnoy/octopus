<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form of `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_admin', 'order_type', 'customer_type', 'payment_type', 'delivery_type', 'order_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['order_no', 'customer_name', 'contact_name', 'contact_info', 'delivery_name'], 'safe'],
            [['phone'],'string'],
            [['appointment_date'],'date'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_admin' => $this->order_admin,
            'order_type' => $this->order_type,
            'customer_type' => $this->customer_type,
            'payment_type' => $this->payment_type,
            'delivery_type' => $this->delivery_type,
//            'phone' => $this->phone,
//            'appointment_date' => $this->appointment_date,
            'order_status' => $this->order_status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_info', $this->contact_info])
            ->andFilterWhere(['like', 'delivery_name', $this->delivery_name]);
           // ->andFilterWhere(['like', 'appointment_date', $this->appointment_date])
           // ->andFilterWhere(['like', 'phone',$this->phone]);

        return $dataProvider;
    }
}
