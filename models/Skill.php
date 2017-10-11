<?php

namespace app\models;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord
{
    /**
     * @access public
     *
     * This method is nesseary to get visitor
     * @return \app\models\Visitor | null
     */
    public function getStyle()
    {
        return $this->hasOne(Visitor::className(), ['id' => 'visitor_id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get visitor
     * @return \app\models\DanceMovement | null
     */
    public function getMovement()
    {
        return $this->hasOne(DanceMovement::className(), ['id' => 'movement_id']);
    }
}