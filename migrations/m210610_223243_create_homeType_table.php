<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%homeType}}`.
*/
class m210610_223243_create_homeType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%homeType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%homeType}}');
   }
}
