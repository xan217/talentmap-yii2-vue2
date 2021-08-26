<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%languages}}`.
*/
class m210824_042555_create_config_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%config}}', [
         'pk_id' => $this->primaryKey(),
         'name' => $this->string(),
         'logo' => $this->string(),
         'primaryColor' => $this->string(),
         'secondaryColor' => $this->string(),
         'tertiaryColor' => $this->string(),
      ]);
      
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%rel_languages}}');
   }
}
