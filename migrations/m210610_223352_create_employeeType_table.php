<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%employeeType}}`.
*/
class m210610_223352_create_employeeType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%employeeType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%employeeType}}');
   }
}
