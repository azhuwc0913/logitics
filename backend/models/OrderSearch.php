<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'buyer_id', 'tel', 'created_time', 'updated_time', 'delete_time'], 'integer'],
            [['order_sn', 'product_code', 'des_country', 'tracking_id', 'consignee', 'street', 'city', 'province', 'email', 'ename',  'tracking_number'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
            'buyer_id' => $this->buyer_id,
            'tel' => $this->tel,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
            'delete_time' => $this->delete_time,
        ]);

        $query->andFilterWhere(['like', 'order_sn', $this->order_sn])
            ->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'des_country', $this->des_country])
            ->andFilterWhere(['like', 'tracking_id', $this->tracking_id])
            ->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ename', $this->ename])
    //            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'tracking_number', $this->tracking_number]);

        return $dataProvider;
    }
}
