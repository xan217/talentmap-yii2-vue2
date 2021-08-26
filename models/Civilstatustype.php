<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "civilstatustype".
 *
 * @property int $pk_id
 * @property string $name
 *
 * @property Userprofile[] $userprofiles
 */
class Civilstatustype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'civilStatusType';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
     * Gets query for [[Userprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofiles()
    {
        return $this->hasMany(Userprofile::className(), ['fk_t_civilStatus_id' => 'pk_id']);
    }
}
