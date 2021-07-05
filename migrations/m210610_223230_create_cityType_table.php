<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%cityType}}`.
*/
class m210610_223230_create_cityType_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%cityType}}', [
         'pk_id' => $this->primaryKey(),
         'fk_t_region_id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
      ]);

      $this->createIndex( 'idx_citytype-region_id', 'citytype', 'fk_t_region_id' );
      $this->addForeignKey( 'fk_citytype-region_id', 'citytype', 'fk_t_region_id', 'regionType', 'pk_id', 'CASCADE' );
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropTable('{{%cityType}}');
   }
}
