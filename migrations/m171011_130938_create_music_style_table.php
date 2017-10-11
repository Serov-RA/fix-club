<?php

use yii\db\Migration;

/**
 * Handles the creation of table `music_style`.
 * Has foreign keys to the tables:
 *
 * - `music_style`
 */
class m171011_130938_create_music_style_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('music_style', [
            'id' => $this->primaryKey(),
            'style_name' => $this->string()->notNull()->defaultValue(''),
            'pid' => $this->integer()->defaultValue(NULL),
        ]);

        // creates index for column `pid`
        $this->createIndex(
            'idx-music_style-pid',
            'music_style',
            'pid'
        );

        // add foreign key for table `music_style`
        $this->addForeignKey(
            'fk-music_style-pid',
            'music_style',
            'pid',
            'music_style',
            'id',
            'CASCADE'
        );

        $styles = [
            'Electrohouse' => NULL,
            'RnB' => NULL,
            'Pop' => NULL,
            'Electrodance' => 1,
            'House' => 1,
            'Hip-hop' => 2,
        ];

        foreach ($styles AS $style => $pid) {
            $this->insert('music_style', ['style_name' => $style]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `music_style`
        $this->dropForeignKey(
            'fk-music_style-pid',
            'music_style'
        );

        // drops index for column `pid`
        $this->dropIndex(
            'idx-music_style-pid',
            'music_style'
        );

        $this->dropTable('music_style');
    }
}
