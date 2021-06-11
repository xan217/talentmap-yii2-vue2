<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%educationLevelType}}`.
*/
class m210611_031025_create_educationLevelType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%educationLevelType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string(45)
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%educationLevelType}}');
   }
}
