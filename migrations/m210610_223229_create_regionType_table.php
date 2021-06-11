<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%regionType}}`.
*/
class m210610_223229_create_regionType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%regionType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%regionType}}');
   }
}
