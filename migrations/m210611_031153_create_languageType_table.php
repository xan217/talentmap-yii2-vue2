<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%languageType}}`.
*/
class m210611_031153_create_languageType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%languageType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string(45),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%languageType}}');
   }
}
