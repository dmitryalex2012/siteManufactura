<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $description
 * @property string $notes
 */
class Works extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title', 'description'], 'string', 'max' => 255],
            [['notes'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'description' => 'Description',
            'notes' => 'Notes',
        ];
    }
}
