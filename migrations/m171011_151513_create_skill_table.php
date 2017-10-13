<?php

use yii\db\Migration;

/**
 * Handles the creation of table `skill`.
 * Has foreign keys to the tables:
 *
 * - `visitor`
 * - `music_style`
 */
class m171011_151513_create_skill_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('skill', [
            'id' => $this->primaryKey(),
            'visitor_id' => $this->integer()->defaultValue(NULL),
            'style_id' => $this->integer()->defaultValue(NULL),
        ]);

        // creates index for column `visitor_id`
        $this->createIndex(
            'idx-skill-visitor_id',
            'skill',
            'visitor_id'
        );

        // add foreign key for table `visitor`
        $this->addForeignKey(
            'fk-skill-visitor_id',
            'skill',
            'visitor_id',
            'visitor',
            'id',
            'CASCADE'
        );

        // creates index for column `style_id`
        $this->createIndex(
            'idx-skill-style_id',
            'skill',
            'style_id'
        );

        // add foreign key for table `music_style`
        $this->addForeignKey(
            'fk-skill-style_id',
            'skill',
            'style_id',
            'music_style',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `visitor`
        $this->dropForeignKey(
            'fk-skill-visitor_id',
            'skill'
        );

        // drops index for column `visitor_id`
        $this->dropIndex(
            'idx-skill-visitor_id',
            'skill'
        );

        // drops foreign key for table `music_style`
        $this->dropForeignKey(
            'fk-skill-style_id',
            'skill'
        );

        // drops index for column `style_id`
        $this->dropIndex(
            'idx-skill-style_id',
            'skill'
        );

        $this->dropTable('skill');
    }
}
