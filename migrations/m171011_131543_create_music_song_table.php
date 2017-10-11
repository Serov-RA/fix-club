<?php

use yii\db\Migration;

/**
 * Handles the creation of table `music_song`.
 * Has foreign keys to the tables:
 *
 * - `music_style`
 */
class m171011_131543_create_music_song_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('music_song', [
            'id' => $this->primaryKey(),
            'song_name' => $this->string()->notNull()->defaultValue(''),
            'style_id' => $this->integer()->defaultValue(NULL),
        ]);

        // creates index for column `style_id`
        $this->createIndex(
            'idx-music_song-style_id',
            'music_song',
            'style_id'
        );

        // add foreign key for table `music_style`
        $this->addForeignKey(
            'fk-music_song-style_id',
            'music_song',
            'style_id',
            'music_style',
            'id',
            'CASCADE'
        );

        $songs = [
            1 => [
                'Electrohouse_song_1',
                'Electrohouse_song_2',
            ],
            2 => [
                'RnB_song_1',
                'RnB_song_2',
                'RnB_song_3',
            ],
            3 => [
                'Pop_song_1',
                'Pop_song_2',
            ],
            4 => [
                'Electrodance_song_1',
            ],
            5 => [
                'House_song_1',
                'House_song_2',
            ],
            6 => [
                'Hip-hop_song_1',
                'Hip_hop_song_2',
            ],
        ];

        foreach ($songs AS $style_id => $song_list) {
            foreach ($song_list AS $song) {
                $this->insert('music_song', ['song_name' => $song, 'style_id' => $style_id]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `music_style`
        $this->dropForeignKey(
            'fk-music_song-style_id',
            'music_song'
        );

        // drops index for column `style_id`
        $this->dropIndex(
            'idx-music_song-style_id',
            'music_song'
        );

        $this->dropTable('music_song');
    }
}
