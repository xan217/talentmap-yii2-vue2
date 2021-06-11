<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%genderType}}`.
*/
class m210610_223342_create_genderType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%genderType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%genderType}}');
   }
}
