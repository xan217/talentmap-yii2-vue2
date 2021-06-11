<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%civilStatusType}}`.
*/
class m210610_223159_create_civilStatusType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%civilStatusType}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%civilStatusType}}');
   }
}
