<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%address}}`.
*/
class m210610_223423_create_address_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%address}}', [
         'pk_id' => $this->primaryKey(),
         'fk_t_region_id' => $this->integer()->notNull(),
         'fk_t_city_id' => $this->integer()->notNull(),
         'streetType' => "ENUM('CARRERA', 'AUTOPISTA', 'CALLE', 'AVENIDA', 'CIRCULAR')",
         'streetNumber' => $this->string(3),
         'streetChar' => $this->string(2),
         'streetCardinal' => "ENUM('NORTE', 'SUR', 'ESTE', 'OESTE')",
         'intersectionNumber' => $this->string(3),
         'intersectionChar' => $this->string(2),
         'intersectionCardinal' => "ENUM('NORTE', 'SUR', 'ESTE', 'OESTE')",
         'buildingNumber' => $this->string(45),
         'complement' => $this->string(100),
         'details' => $this->string(100)
      ]);
      
      $this->createIndex( 'idx_address-region_id', 'address', 'fk_t_region_id' );
      $this->addForeignKey( 'fk_address-region_id', 'address', 'fk_t_region_id', 'regionType', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_address-city_id', 'address', 'fk_t_city_id' );
      $this->addForeignKey( 'fk_address-city_id', 'address', 'fk_t_city_id', 'cityType', 'pk_id', 'CASCADE' );
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropForeignKey( 'fk_address-city_id', 'address' );
      $this->dropIndex( 'idx_address-city_id', 'address' );

      $this->dropForeignKey( 'fk_address-region_id', 'address' );
      $this->dropIndex( 'idx_address-region_id', 'address' );

      $this->dropTable('{{%address}}');
   }
}
