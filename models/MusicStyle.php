<?php

namespace app\models;

use yii\db\ActiveRecord;

class MusicStyle extends ActiveRecord
{
    /**
     * @access public
     *
     * This method is nesseary to get parent music style
     * @return \app\models\MusicStyle | null
     */
    public function getParentStyle()
    {
        return $this->hasOne(MusicStyle::className(), ['id' => 'pid']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get children music styles
     * @return array
     */
    public function getSubstyles()
    {
        return $this->hasMany(MusicStyle::className(), ['pid' => 'id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get songs
     * @return array
     */
    public function getSongs()
    {
        return $this->hasMany(MusicSong::className(), ['style_id' => 'id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get movements
     * @return array
     */
    public function getMovements()
    {
        return $this->hasMany(DanceMovement::className(), ['style_id' => 'id']);
    }
}