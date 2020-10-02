<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $categories
 * @property string $categoriesBredCrumbs
 * @property string $title
 * @property string $address
 * @property string $content
 * @property string $description
 * @property string $size
 * @property int $number
 * @property int $price
 */
class Products extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'price'], 'integer'],
            [['categories', 'categoriesBredCrumbs', 'title', 'address', 'content', 'size'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 10000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categories' => 'Categories',
            'categoriesBredCrumbs' => 'Categories Bred Crumbs',
            'title' => 'Title',
            'address' => 'Address',
            'content' => 'Content',
            'description' => 'Description',
            'size' => 'Size',
            'number' => 'Number',
            'price' => 'Price',
        ];
    }

    /**
     * Get product from DB
     *
     * @param $stringID
     *
     * @return mixed
     *
     * @throws \yii\base\InvalidConfigException
     */
    public static function findProductStringByID($stringID)
    {
        return static::find()->where(['id' => $stringID])->one();
    }
}
