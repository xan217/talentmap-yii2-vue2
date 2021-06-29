<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $pk_id
 * @property int $fk_region_id
 * @property int $fk_city_id
 * @property string|null $streetType
 * @property string|null $streetNumber
 * @property string|null $streetChar
 * @property string|null $streetCardinal
 * @property string|null $intersectionNumber
 * @property string|null $intersectionChar
 * @property string|null $intersectionCardinal
 * @property string|null $buildingNumber
 * @property string|null $complement
 * @property string|null $details
 *
 * @property Citytype $fkCity
 * @property Regiontype $fkRegion
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_region_id', 'fk_city_id'], 'required'],
            [['fk_region_id', 'fk_city_id'], 'integer'],
            [['streetType', 'streetCardinal', 'intersectionCardinal'], 'string'],
            [['streetNumber', 'intersectionNumber'], 'string', 'max' => 3],
            [['streetChar', 'intersectionChar'], 'string', 'max' => 2],
            [['buildingNumber'], 'string', 'max' => 45],
            [['complement', 'details'], 'string', 'max' => 100],
            [['fk_city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Citytype::className(), 'targetAttribute' => ['fk_city_id' => 'pk_id']],
            [['fk_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regiontype::className(), 'targetAttribute' => ['fk_region_id' => 'pk_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'fk_region_id' => 'Fk Region ID',
            'fk_city_id' => 'Fk City ID',
            'streetType' => 'Street Type',
            'streetNumber' => 'Street Number',
            'streetChar' => 'Street Char',
            'streetCardinal' => 'Street Cardinal',
            'intersectionNumber' => 'Intersection Number',
            'intersectionChar' => 'Intersection Char',
            'intersectionCardinal' => 'Intersection Cardinal',
            'buildingNumber' => 'Building Number',
            'complement' => 'Complement',
            'details' => 'Details',
        ];
    }

    /**
     * Gets query for [[FkCity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkCity()
    {
        return $this->hasOne(Citytype::className(), ['pk_id' => 'fk_city_id']);
    }

    /**
     * Gets query for [[FkRegion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkRegion()
    {
        return $this->hasOne(Regiontype::className(), ['pk_id' => 'fk_region_id']);
    }
}
