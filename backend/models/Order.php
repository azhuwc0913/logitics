<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $order_sn
 * @property string $product_code
 * @property string $des_country
 * @property integer $buyer_id
 * @property string $tracking_id
 * @property string $consignee
 * @property string $street
 * @property string $post
 * @property string $city
 * @property string $province
 * @property integer $tel
 * @property string $email
 * @property string $ename
 * @property string $track_content
 * @property string $track_code
 * @property string $tracking_number
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $delete_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buyer_id', 'tel', 'created_time', 'updated_time', 'delete_time'], 'integer'],
            [['order_sn', 'product_code', 'des_country'], 'string', 'max' => 20],
            [['tracking_id'], 'string', 'max' => 64],
            [['consignee', 'city', 'province', 'email'], 'string', 'max' => 60],
            [['street'], 'string', 'max' => 255],
            [['post'], 'string', 'max' => 30],
            [['ename', 'track_content'], 'string', 'max' => 250],
            [['track_code'], 'string', 'max' => 32],
            [['tracking_number'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_sn' => 'Order Sn',
            'product_code' => 'Product Code',
            'des_country' => 'Des Country',
            'buyer_id' => 'Buyer ID',
            'tracking_id' => 'Tracking ID',
            'consignee' => 'Consignee',
            'street' => 'Street',
            'post' => 'Post',
            'city' => 'City',
            'province' => 'Province',
            'tel' => 'Tel',
            'email' => 'Email',
            'ename' => 'Ename',
            'track_content' => 'Track Content',
            'track_code' => 'Track Code',
            'tracking_number' => 'Tracking Number',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'delete_time' => 'Delete Time',
        ];
    }

    public function queryGuiji($tracking_number){

        @ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

        set_time_limit(600);

        include './4px/OrderOnlineTools.php';

        $soap = new \OrderOnlineTools();



        //这个地方要使用创建订单时候的tracking_number来查，而不是订单号
        $arrs = [
            $tracking_number
        ];

        return $result = $soap->cargoTrackingService($arrs);

    }
}
