<?php

namespace app\models;

use yii\db\ActiveRecord;

class Visitor extends ActiveRecord
{
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

    /**
     * @access public
     *
     * This method is nesseary to get action
     * @return Action | null
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get skills
     * @return array
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['visitor_id' => 'id']);
    }
}