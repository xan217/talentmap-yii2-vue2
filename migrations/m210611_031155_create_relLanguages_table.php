<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%languages}}`.
*/
class m210611_031155_create_relLanguages_table extends Migration
{
   /**
   * {@inheritdoc}
   */
   public function safeUp()
   {
      $this->createTable('{{%rel_languages}}', [
         'id' => $this->primaryKey(),
         'fk_userprofile_id' => $this->integer()->notNull(),
         'fk_language_id' => $this->integer()->notNull(),
      ]);
      
      $this->createIndex( 'idx_relLanguages-userprofile_id', 'rel_languages', 'fk_userprofile_id' );
      $this->addForeignKey( 'fk_relLanguages-userprofile_id', 'rel_languages', 'fk_userprofile_id', 'userprofile', 'pk_id', 'CASCADE' );
      
      $this->createIndex( 'idx_relLanguages-language_id', 'rel_languages', 'fk_language_id' );
      $this->addForeignKey( 'fk_relLanguages-language_id', 'rel_languages', 'fk_language_id', 'languageType', 'pk_id', 'CASCADE' );
   }
   
   /**
   * {@inheritdoc}
   */
   public function safeDown()
   {
      $this->dropForeignKey( 'fk_relLanguages-userprofile_id', 'rel_languages' );
      $this->dropIndex( 'idx_relLanguages-userprofile_id', 'rel_languages' );

      $this->dropForeignKey( 'fk_relLanguages-language_id', 'rel_languages' );
      $this->dropIndex( 'idx_relLanguages-language_id', 'rel_languages' );

      $this->dropTable('{{%rel_languages}}');
   }
}
