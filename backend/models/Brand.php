<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $brand_name
 * @property integer $type
 * @property string $model_name
 * @property integer $p_id
 * @property integer $cat_id
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'p_id', 'cat_id'], 'integer'],
            [['brand_name', 'model_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_name' => 'Brand Name',
            'type' => 'Type',
            'model_name' => 'Model Name',
            'p_id' => 'P ID',
            'cat_id' => 'Cat ID',
        ];
    }

    public function getBrandName($brand_id){
        $data = $this->find()->where(['id'=>$brand_id])->asArray()->one();

        return $data['brand_name'];
    }
}
