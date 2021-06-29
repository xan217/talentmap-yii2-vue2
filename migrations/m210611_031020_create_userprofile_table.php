<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%userprofile}}`.
*/
class m210611_031020_create_userprofile_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%userprofile}}', [
         'pk_id' => $this->primaryKey(),
         'fk_t_blood_id' => $this->integer()->notNull(),
         'fk_t_civilstatus_id' => $this->integer()->notNull(),
         'fk_t_home_id' => $this->integer()->notNull(),
         'fk_t_transport_id' => $this->integer()->notNull(),
         'fk_t_smoker_id' => $this->integer()->notNull(),
         'fk_t_drinker_id' => $this->integer()->notNull(),
         'fk_t_gender_id' => $this->integer()->notNull(),
         'fk_t_employee_id' => $this->integer()->notNull(),
         'fk_address_id' => $this->integer()->notNull(),
         'name' => $this->string(100),
         'lastname' => $this->string(100),
         'idCard' => $this->string(15),
         'childNumber' => $this->integer(1),
         'livesAlone' => "ENUM('SI', 'NO')",
         'status' => "ENUM('ACTIVE', 'INACTIVE', 'DELETED')",
         'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
         'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
      ]);
      
      $this->createIndex( 'idx_userprofile-blood_id', 'userprofile', 'fk_t_blood_id' );
      $this->addForeignKey( 'fk_userprofile-blood_id', 'userprofile', 'fk_t_blood_id', 'bloodType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-civilStatus_id', 'userprofile', 'fk_t_civilstatus_id' );
      $this->addForeignKey( 'fk_userprofile-civilStatus_id', 'userprofile', 'fk_t_civilstatus_id', 'civilStatusType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-home_id', 'userprofile', 'fk_t_home_id' );
      $this->addForeignKey( 'fk_userprofile-home_id', 'userprofile', 'fk_t_home_id', 'homeType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-transport_id', 'userprofile', 'fk_t_transport_id' );
      $this->addForeignKey( 'fk_userprofile-transport_id', 'userprofile', 'fk_t_transport_id', 'transportType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-smoker_id', 'userprofile', 'fk_t_smoker_id' );
      $this->addForeignKey( 'fk_userprofile-smoker_id', 'userprofile', 'fk_t_smoker_id', 'smokerType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-drinker_id', 'userprofile', 'fk_t_drinker_id' );
      $this->addForeignKey( 'fk_userprofile-drinker_id', 'userprofile', 'fk_t_drinker_id', 'drinkerType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-gender_id', 'userprofile', 'fk_t_gender_id' );
      $this->addForeignKey( 'fk_userprofile-gender_id', 'userprofile', 'fk_t_gender_id', 'genderType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_userprofile-employee_id', 'userprofile', 'fk_t_employee_id' );
      $this->addForeignKey( 'fk_userprofile-employee_id', 'userprofile', 'fk_t_employee_id', 'employeeType', 'pk_id', 'CASCADE' );
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropForeignKey( 'fk_userprofile-blood_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-blood_id', 'userprofile' );
      
      $this->dropForeignKey( 'fk_userprofile-civilStatus_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-civilStatus_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-home_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-home_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-transport_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-transport_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-smoker_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-smoker_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-drinker_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-drinker_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-gender_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-gender_id', 'userprofile' );

      $this->dropForeignKey( 'fk_userprofile-employee_id', 'userprofile' );
      $this->dropIndex( 'idx_userprofile-employee_id', 'userprofile' );

      $this->dropTable('{{%userprofile}}');
   }
}
