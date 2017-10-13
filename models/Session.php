<?php

namespace app\models;

use Yii;
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


    /**
     * @access public
     *
     * Create or get session
     */
    public static function getCurrentSession()
    {
        $session = Yii::$app->session;
        $session->open();

        $current_session = self::findOne(['sid' => $session->getId()]);

        if (!$current_session) {
            $current_session = new self;
            $current_session->sid = $session->getId();
            $current_session->last_update = date('Y-m-d H:i:s');
            $current_session->save();
        }

        return $current_session;
    }
}