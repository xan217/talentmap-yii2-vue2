<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_educationlevel".
 *
 * @property int $pk_id
 * @property int $fk_userprofile_id
 * @property int $fk_educationLevel_id
 * @property int $fk_educationStatus_id
 *
 * @property Educationleveltype $fkEducationLevel
 * @property Educationstatustype $fkEducationStatus
 * @property Userprofile $fkUserprofile
 */
class RelEducationlevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rel_educationLevel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_userprofile_id', 'fk_educationLevel_id', 'fk_educationStatus_id'], 'required'],
            [['fk_userprofile_id', 'fk_educationLevel_id', 'fk_educationStatus_id'], 'integer'],
            [['fk_educationLevel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Educationleveltype::className(), 'targetAttribute' => ['fk_educationLevel_id' => 'pk_id']],
            [['fk_educationStatus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Educationstatustype::className(), 'targetAttribute' => ['fk_educationStatus_id' => 'pk_id']],
            [['fk_userprofile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::className(), 'targetAttribute' => ['fk_userprofile_id' => 'pk_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'fk_userprofile_id' => 'Fk Userprofile ID',
            'fk_educationLevel_id' => 'Fk Education Level ID',
            'fk_educationStatus_id' => 'Fk Education Status ID',
        ];
    }

    /**
     * Gets query for [[FkEducationLevel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEducationLevel()
    {
        return $this->hasOne(Educationleveltype::className(), ['pk_id' => 'fk_educationLevel_id']);
    }

    /**
     * Gets query for [[FkEducationStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkEducationStatus()
    {
        return $this->hasOne(Educationstatustype::className(), ['pk_id' => 'fk_educationStatus_id']);
    }

    /**
     * Gets query for [[FkUserprofile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkUserprofile()
    {
        return $this->hasOne(Userprofile::className(), ['pk_id' => 'fk_userprofile_id']);
    }
}
