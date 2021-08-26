<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "educationstatustype".
 *
 * @property int $pk_id
 * @property string|null $name
 *
 * @property RelEducationlevel[] $relEducationlevels
 */
class Educationstatustype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'educationStatusType';
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
     * Gets query for [[RelEducationlevels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelEducationlevels()
    {
        return $this->hasMany(RelEducationlevel::className(), ['fk_educationStatus_id' => 'pk_id']);
    }
}
