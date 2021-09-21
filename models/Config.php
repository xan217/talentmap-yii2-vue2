<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "config".
 *
 * @property int $pk_id
 * @property string|null $field
 * @property string|null $value
 */
class Config extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field', 'value'], 'string', 'max' => 512],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'field' => 'Campo',
            'value' => 'Valor'
        ];
    }
}
