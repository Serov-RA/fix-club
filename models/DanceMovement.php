<?php

namespace app\models;

use yii\db\ActiveRecord;

class DanceMovement extends ActiveRecord
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
     * This method is nesseary to get skills
     * @return array
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['movement_id' => 'id']);
    }
}