<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visitor`.
 * Has foreign keys to the tables:
 *
 * - `session`
 * - `action`
 */
class m171011_151254_create_visitor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('visitor', [
            'id' => $this->primaryKey(),
            'sid' => $this->integer()->defaultValue(NULL),
            'sex' => $this->string(6)->notNull()->defaultValue(''),
            'action' => $this->integer()->defaultValue(NULL),
        ]);

        // creates index for column `sid`
        $this->createIndex(
            'idx-visitor-sid',
            'visitor',
            'sid'
        );

        // add foreign key for table `session`
        $this->addForeignKey(
            'fk-visitor-sid',
            'visitor',
            'sid',
            'session',
            'id',
            'CASCADE'
        );

        // creates index for column `action`
        $this->createIndex(
            'idx-visitor-action',
            'visitor',
            'action'
        );

        // add foreign key for table `action`
        $this->addForeignKey(
            'fk-visitor-action',
            'visitor',
            'action',
            'action',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `session`
        $this->dropForeignKey(
            'fk-visitor-sid',
            'visitor'
        );

        // drops index for column `sid`
        $this->dropIndex(
            'idx-visitor-sid',
            'visitor'
        );

        // drops foreign key for table `action`
        $this->dropForeignKey(
            'fk-visitor-action',
            'visitor'
        );

        // drops index for column `action`
        $this->dropIndex(
            'idx-visitor-action',
            'visitor'
        );

        $this->dropTable('visitor');
    }
}
