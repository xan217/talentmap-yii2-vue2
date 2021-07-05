<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "citytype".
 *
 * @property int $pk_id
 * @property string $name
 *
 * @property Address[] $addresses
 */
class Citytype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'citytype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['fk_t_region_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'fk_t_region_id' => 'Fk T Region ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['fk_t_city_id' => 'pk_id']);
    }
}
