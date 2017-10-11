<?php

namespace app\models;

use yii\db\ActiveRecord;

class MusicSong extends ActiveRecord
{
    /**
     * @access public
     *
     * This method is nesseary to get music style
     * @return \app\models\MusicStyle | null
     */
    public function getStyle()
    {
        return $this->hasOne(MusicStyle::className(), ['id' => 'style_id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get playlist records
     * @return array
     */
    public function getFromPlaylist()
    {
        return $this->hasMany(Playlist::className(), ['song_id' => 'id']);
    }
}