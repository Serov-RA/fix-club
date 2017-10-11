<?php

use yii\db\Migration;

/**
 * Handles the creation of table `action`.
 */
class m171011_151200_create_action_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('action', [
            'id' => $this->primaryKey(),
            'action' => $this->string()->notNull()->defaultValue(NULL),
        ]);

        $actions = ['dance', 'drink'];

        foreach ($actions AS $action) {
            $this->insert('action', ['action' => $action]);
        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('action');
    }
}
