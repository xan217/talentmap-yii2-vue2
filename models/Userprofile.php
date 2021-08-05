<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $pk_id
 * @property int $fk_t_blood_id
 * @property int $fk_t_civilStatus_id
 * @property int $fk_t_home_id
 * @property int $fk_t_transport_id
 * @property int $fk_t_smoker_id
 * @property int $fk_t_drinker_id
 * @property int $fk_t_gender_id
 * @property int $fk_t_employee_id
 * @property int $fk_address_id
 * @property string|null $name
 * @property string|null $lastname
 * @property string|null $idCard
 * @property int|null $childNumber
 * @property string|null $livesAlone
 * @property string|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property RelEducationlevel[] $relEducationlevels
 * @property RelLanguages[] $relLanguages
 * @property Bloodtype $fkTBlood
 * @property Civilstatustype $fkTCivilStatus
 * @property Drinkertype $fkTDrinker
 * @property Employeetype $fkTEmployee
 * @property Gendertype $fkTGender
 * @property Hometype $fkTHome
 * @property Smokertype $fkTSmoker
 * @property Transporttype $fkTTransport
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_t_blood_id', 'fk_t_civilstatus_id', 'fk_t_home_id', 'fk_t_transport_id', 'fk_t_smoker_id', 'fk_t_drinker_id', 'fk_t_gender_id', 'fk_t_employee_id', 'fk_address_id'], 'default', 'value' => null],
            [['fk_t_blood_id', 'fk_t_civilstatus_id', 'fk_t_home_id', 'fk_t_transport_id', 'fk_t_smoker_id', 'fk_t_drinker_id', 'fk_t_gender_id', 'fk_t_employee_id', 'fk_address_id', 'childNumber'], 'integer'],
            [['status'], 'string'],
            [['livesAlone'], 'string'],
            [['idCard'], 'string', 'max' => 15],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'lastname'], 'string', 'max' => 100],
            [['fk_t_home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hometype::className(), 'targetAttribute' => ['fk_t_home_id' => 'pk_id']],
            [['fk_t_blood_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bloodtype::className(), 'targetAttribute' => ['fk_t_blood_id' => 'pk_id']],
            [['fk_t_gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gendertype::className(), 'targetAttribute' => ['fk_t_gender_id' => 'pk_id']],
            [['fk_t_smoker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Smokertype::className(), 'targetAttribute' => ['fk_t_smoker_id' => 'pk_id']],
            [['fk_t_drinker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drinkertype::className(), 'targetAttribute' => ['fk_t_drinker_id' => 'pk_id']],
            [['fk_t_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employeetype::className(), 'targetAttribute' => ['fk_t_employee_id' => 'pk_id']],
            [['fk_t_transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transporttype::className(), 'targetAttribute' => ['fk_t_transport_id' => 'pk_id']],
            [['fk_t_civilstatus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Civilstatustype::className(), 'targetAttribute' => ['fk_t_civilstatus_id' => 'pk_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pk_id' => 'Pk ID',
            'fk_t_blood_id' => 'Fk T Blood ID',
            'fk_t_civilstatus_id' => 'Fk T Civil Status ID',
            'fk_t_home_id' => 'Fk T Home ID',
            'fk_t_transport_id' => 'Fk T Transport ID',
            'fk_t_smoker_id' => 'Fk T Smoker ID',
            'fk_t_drinker_id' => 'Fk T Drinker ID',
            'fk_t_gender_id' => 'Fk T Gender ID',
            'fk_t_employee_id' => 'Fk T Employee ID',
            'fk_address_id' => 'Fk Address ID',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'idCard' => 'Id Card',
            'childNumber' => 'Child Number',
            'livesAlone' => 'Lives Alone',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RelEducationlevels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelEducationlevels()
    {
        return $this->hasMany(RelEducationlevel::className(), ['fk_userprofile_id' => 'pk_id']);
    }

    /**
     * Gets query for [[RelLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelLanguages()
    {
        return $this->hasMany(RelLanguages::className(), ['fk_userprofile_id' => 'pk_id']);
    }

    /**
     * Gets query for [[FkTBlood]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTBlood()
    {
        return $this->hasOne(Bloodtype::className(), ['pk_id' => 'fk_t_blood_id']);
    }

    /**
     * Gets query for [[FkTCivilStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTCivilStatus()
    {
        return $this->hasOne(Civilstatustype::className(), ['pk_id' => 'fk_t_civilstatus_id']);
    }

    /**
     * Gets query for [[FkTDrinker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTDrinker()
    {
        return $this->hasOne(Drinkertype::className(), ['pk_id' => 'fk_t_drinker_id']);
    }

    /**
     * Gets query for [[FkTEmployee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTEmployee()
    {
        return $this->hasOne(Employeetype::className(), ['pk_id' => 'fk_t_employee_id']);
    }

    /**
     * Gets query for [[FkTGender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTGender()
    {
        return $this->hasOne(Gendertype::className(), ['pk_id' => 'fk_t_gender_id']);
    }

    /**
     * Gets query for [[FkTHome]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTHome()
    {
        return $this->hasOne(Hometype::className(), ['pk_id' => 'fk_t_home_id']);
    }

    /**
     * Gets query for [[FkTSmoker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTSmoker()
    {
        return $this->hasOne(Smokertype::className(), ['pk_id' => 'fk_t_smoker_id']);
    }

    /**
     * Gets query for [[FkTTransport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkTTransport()
    {
        return $this->hasOne(Transporttype::className(), ['pk_id' => 'fk_t_transport_id']);
    }
    
    /**
     * Gets query for [[FkAddress]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['pk_id' => 'fk_address_id']);
    }
}
