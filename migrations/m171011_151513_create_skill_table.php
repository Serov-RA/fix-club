<?php

use yii\db\Migration;

/**
 * Handles the creation of table `skill`.
 * Has foreign keys to the tables:
 *
 * - `visitor`
 * - `dance_movement`
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
            'movement_id' => $this->integer()->defaultValue(NULL),
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

        // creates index for column `movement_id`
        $this->createIndex(
            'idx-skill-movement_id',
            'skill',
            'movement_id'
        );

        // add foreign key for table `dance_movement`
        $this->addForeignKey(
            'fk-skill-movement_id',
            'skill',
            'movement_id',
            'dance_movement',
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

        // drops foreign key for table `dance_movement`
        $this->dropForeignKey(
            'fk-skill-movement_id',
            'skill'
        );

        // drops index for column `movement_id`
        $this->dropIndex(
            'idx-skill-movement_id',
            'skill'
        );

        $this->dropTable('skill');
    }
}
