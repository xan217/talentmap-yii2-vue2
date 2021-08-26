<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "languagetype".
 *
 * @property int $pk_id
 * @property string|null $name
 *
 * @property RelLanguages[] $relLanguages
 */
class Languagetype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languageType';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[RelLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelLanguages()
    {
        return $this->hasMany(RelLanguages::className(), ['fk_language_id' => 'pk_id']);
    }
}
