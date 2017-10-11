<?php

use yii\db\Migration;

/**
 * Handles the creation of table `playlist`.
 * Has foreign keys to the tables:
 *
 * - `session`
 * - `music_song`
 */
class m171011_150536_create_playlist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('playlist', [
            'id' => $this->primaryKey(),
            'sid' => $this->integer()->defaultValue(NULL),
            'song_id' => $this->integer()->defaultValue(NULL),
            'is_play' => $this->integer(1)->notNull()->defaultValue(0),
        ]);

        // creates index for column `sid`
        $this->createIndex(
            'idx-playlist-sid',
            'playlist',
            'sid'
        );

        // add foreign key for table `session`
        $this->addForeignKey(
            'fk-playlist-sid',
            'playlist',
            'sid',
            'session',
            'id',
            'CASCADE'
        );

        // creates index for column `song_id`
        $this->createIndex(
            'idx-playlist-song_id',
            'playlist',
            'song_id'
        );

        // add foreign key for table `music_song`
        $this->addForeignKey(
            'fk-playlist-song_id',
            'playlist',
            'song_id',
            'music_song',
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
            'fk-playlist-sid',
            'playlist'
        );

        // drops index for column `sid`
        $this->dropIndex(
            'idx-playlist-sid',
            'playlist'
        );

        // drops foreign key for table `music_song`
        $this->dropForeignKey(
            'fk-playlist-song_id',
            'playlist'
        );

        // drops index for column `song_id`
        $this->dropIndex(
            'idx-playlist-song_id',
            'playlist'
        );

        $this->dropTable('playlist');
    }
}
