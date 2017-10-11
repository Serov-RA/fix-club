<?php

namespace app\models;

use yii\db\ActiveRecord;

class Session extends ActiveRecord
{
    /**
     * @access public
     *
     * This method is nesseary to get visitors
     * @return array
     */
    public function getVisitors()
    {
        return $this->hasMany(Visitor::className(), ['sid' => 'id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get playlist
     * @return array
     */
    public function getPlaylist()
    {
        return $this->hasMany(Playlist::className(), ['sid' => 'id']);
    }
}