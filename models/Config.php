<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "config".
 *
 * @property int $pk_id
 * @property string|null $companyName
 * @property string|null $companyLogo
 * @property string|null $primaryColor
 * @property string|null $secondaryColor
 * @property string|null $tertiaryColor
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
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['name', 'logo'], 'string', 'max' => 512],
            [['primaryColor', 'secondaryColor', 'tertiaryColor'], 'string', 'max' => 7],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'name' => 'Company Name',
            'logo' => 'Company Logo',
            'primaryColor' => 'Primary Color',
            'secondaryColor' => 'Secondary Color',
            'tertiaryColor' => 'Tertiary Color',
        ];
    }
}
