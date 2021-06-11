<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%cityType}}`.
*/
class m210610_223221_create_cityType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%cityType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%cityType}}');
   }
}
