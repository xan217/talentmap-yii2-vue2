<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%smokerType}}`.
*/
class m210610_223319_create_smokerType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%smokerType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%smokerType}}');
   }
}
