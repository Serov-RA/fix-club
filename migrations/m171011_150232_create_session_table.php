<?php

use yii\db\Migration;

/**
 * Handles the creation of table `session`.
 */
class m171011_150232_create_session_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('session', [
            'id' => $this->primaryKey(),
            'sid' => $this->string()->notNull()->defaultValue(''),
            'last_update' => $this->datetime()->defaultValue(NULL),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('session');
    }
}
