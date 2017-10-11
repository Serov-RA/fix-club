<?php

namespace app\models;

use yii\db\ActiveRecord;

class Playlist extends ActiveRecord
{
    /**
     * @access public
     *
     * This method is nesseary to get song
     * @return \app\models\MusicSong | null
     */
    public function getSong()
    {
        return $this->hasOne(MusicSong::className(), ['id' => 'song_id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get session
     * @return \app\models\Session | null
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'sid']);
    }
}