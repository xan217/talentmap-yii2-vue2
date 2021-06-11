<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%transportType}}`.
*/
class m210610_223257_create_transportType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%transportType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%transportType}}');
   }
}
