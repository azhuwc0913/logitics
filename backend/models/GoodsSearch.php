<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `backend\models\Goods`.
 */
class GoodsSearch extends Goods
{

    public $created_from;
    public $created_to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_time', 'updated_time', 'cat_id', 'goods_number'], 'integer'],
            [['goods_name', 'title', 'brand_id', 'description', 'content', 'model_id', 'group', 'goods_sn', 'logo'], 'safe'],
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
        $query = Goods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
//        dd($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'goods_number' => $this->goods_number,
        ]);

        $query->andFilterWhere(['like', 'goods_name', $this->goods_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'brand_id', $this->brand_id])
            ->andFilterWhere(['like', 'model_id', $this->model_id])
            ->andFilterWhere(['like', 'group',$this->group])
            ->andFilterWhere(['like', 'goods_sn', $this->goods_sn])
            ->andFilterWhere(['like', 'logo', $this->logo]);
        $this->created_from = isset($params['GoodsSearch']['created_from'])?strtotime($params['GoodsSearch']['created_from']):'';
        $this->created_to = isset($params['GoodsSearch']['created_to'])?strtotime($params['GoodsSearch']['created_to']):'';

        if($this->created_from){
            $query->andFilterWhere([
                '>=', 'created_time', $this->created_from
            ]);
            $this->created_from = date('Y-m-d H:i:s',  $this->created_from);
        }
        if($this->created_to){
            $query->andFilterWhere([
                '<=', 'created_time', $this->created_to
            ]);
            $this->created_to = date('Y-m-d H:i:s',  $this->created_to);
        }

        return $dataProvider;
    }
}
