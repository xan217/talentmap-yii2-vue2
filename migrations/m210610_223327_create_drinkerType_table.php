<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%drinkerType}}`.
*/
class m210610_223327_create_drinkerType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%drinkerType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%drinkerType}}');
   }
}
