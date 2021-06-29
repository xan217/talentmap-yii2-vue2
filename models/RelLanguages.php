<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_languages".
 *
 * @property int $id
 * @property int $fk_userprofile_id
 * @property int $fk_language_id
 *
 * @property Languagetype $fkLanguage
 * @property Userprofile $fkUserprofile
 */
class RelLanguages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rel_languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_userprofile_id', 'fk_language_id'], 'required'],
            [['fk_userprofile_id', 'fk_language_id'], 'integer'],
            [['fk_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languagetype::className(), 'targetAttribute' => ['fk_language_id' => 'pk_id']],
            [['fk_userprofile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::className(), 'targetAttribute' => ['fk_userprofile_id' => 'pk_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_userprofile_id' => 'Fk Userprofile ID',
            'fk_language_id' => 'Fk Language ID',
        ];
    }

    /**
     * Gets query for [[FkLanguage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkLanguage()
    {
        return $this->hasOne(Languagetype::className(), ['pk_id' => 'fk_language_id']);
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
