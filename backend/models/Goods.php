<?php

namespace backend\models;

use common\models\AES;
use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property string $id
 * @property string $goods_name
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $brand_id
 * @property string $model_id
 * @property string $group
 * @property string $goods_sn
 * @property string $logo
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $cat_id
 * @property integer $goods_number
 * @property string $price
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['goods_sn', 'created_time', 'updated_time', 'cat_id', 'goods_number'], 'integer'],
            [['price'], 'number'],
            [['goods_name', 'title'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 255],
            [['brand_id', 'model_id', 'logo'], 'string', 'max' => 64],
            [['group'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_name' => '商品名称',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'brand_id' => 'Brand ID',
            'model_id' => 'Model ID',
            'group' => '适用人群',
            'goods_sn' => '商品编号',
            'logo' => 'Logo',
            'created_time' => '创建时间',
            'updated_time' => 'Updated Time',
            'cat_id' => 'Cat ID',
            'goods_number' => '商品库存',
            'price' => 'Price',
        ];
    }

    public function getRecentData($start_time, $end_time){

        return $data  = $this->find()->where(['between','created_time',$start_time, $end_time])->asArray()->all();
    }

    public function getData($model,$url){


        $path = Yii::$app->params['rootPath'];

        $data = [];
        if($model->updated_time){
            $data['updated_time'] = $model->updated_time;
        }
        $data['goods_id'] = $model->id;

        $data['goods_pic'] = $path . $model->logo;

        $data['created_time'] = $model->created_time;

        $data['goods_title'] = $model->title;

        $data['goods_name'] = $model->goods_name;

        $data['goods_description'] = $model->description;

        $data['goods_content'] = $model->content;

        $data['goods_number'] = $model->goods_number;

        $data['goods_sn'] = $model->goods_sn;

        $data['m_id'] = ','.$model->model_id;

        $data['price'] = $model->price;

        $data['goods_create_time'] = $model->created_time;

        $group = $model->group;

        $group = explode(',', $group);

        $res = [];

        foreach($group as $v){
            if($v==0){
                $res[] = 'female';
            }elseif($v==1){
                $res[] = 'male';
            }
        }
        $data['group'] = implode(',', $res);

        $data['category'] = ['cat_id' => $model->cat_id, 'cat_name' => (new Category())->getCateName($model->cat_id)];

        $ids = explode(',', $model->model_id);

        $model_data = Brand::find()->where(['id' => $ids])->asArray()->all();

        foreach ($model_data as $v) {
            $data['brand'][$v['p_id']][] = ['brand_name' => (new Brand())->getBrandName($v['p_id']), 'model' => ['model_id' => $v['id'], 'model_name' => $v['model_name']]];
        }

        //dd($data);
        $aec=  new AES();

        $data = json_encode($data);

        $data = $aec->encode($data);
        //发送curl请求，将数据传送给相应的网站
        $res = $this->postTest($url, $data);

        return $res;
    }


    public function deleteData($model, $url){

        $data = $model->id;

        $aec=  new AES();

        $data = json_encode($data);

        $data = $aec->encode($data);

        $res = $this->postTest($url, $data);

        return $res;
    }

    public function postTest($url, $data, $header=array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'data=' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

}
