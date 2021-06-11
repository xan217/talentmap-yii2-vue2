<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%educationLevel}}`.
*/
class m210611_031037_create_relEducationLevel_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%rel_educationLevel}}', [
         'pk_id' => $this->primaryKey(),
         'fk_userprofile_id' => $this->integer()->notNull(),
         'fk_educationLevel_id' => $this->integer()->notNull(),
         'fk_educationStatus_id' => $this->integer()->notNull(),
      ]);
      
      $this->createIndex( 'idx_relEducationLevel-userprofile_id', 'rel_educationLevel', 'fk_userprofile_id' );
      $this->addForeignKey( 'fk_relEducationLevel-userprofile_id', 'rel_educationLevel', 'fk_userprofile_id', 'userprofile', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_relEducationLevel-educationLevel_id', 'rel_educationLevel', 'fk_educationLevel_id' );
      $this->addForeignKey( 'fk_relEducationLevel-educationLevel_id', 'rel_educationLevel', 'fk_educationLevel_id', 'educationLevelType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_relEducationLevel-educationStatus_id', 'rel_educationLevel', 'fk_educationStatus_id' );
      $this->addForeignKey( 'fk_relEducationLevel-educationStatus_id', 'rel_educationLevel', 'fk_educationStatus_id', 'educationStatusType', 'pk_id', 'CASCADE' );
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropForeignKey( 'fk_relEducationLevel-userprofile_id', 'rel_educationLevel' );
      $this->dropIndex( 'idx_relEducationLevel-userprofile_id', 'rel_educationLevel' );

      $this->dropForeignKey( 'fk_relEducationLevel-educationLevel_id', 'rel_educationLevel' );
      $this->dropIndex( 'idx_relEducationLevel-educationLevel_id', 'rel_educationLevel' );

      $this->dropForeignKey( 'fk_relEducationLevel-educationStatus_id', 'rel_educationLevel' );
      $this->dropIndex( 'idx_relEducationLevel-educationStatus_id', 'rel_educationLevel' );

      $this->dropTable('{{%rel_educationLevel}}');
   }
}
