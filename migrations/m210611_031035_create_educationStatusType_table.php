<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%educationStatusType}}`.
*/
class m210611_031035_create_educationStatusType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%educationStatusType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string(45)
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%educationStatusType}}');
   }
}
