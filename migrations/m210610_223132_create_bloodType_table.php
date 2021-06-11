<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%bloodType}}`.
*/
class m210610_223132_create_bloodType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%bloodType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%bloodType}}');
   }
}
