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
    public function getVisitor()
    {
        return $this->hasOne(Visitor::className(), ['id' => 'visitor_id']);
    }

    /**
     * @access public
     *
     * This method is nesseary to get visitor
     * @return \app\models\MusicStyle | null
     */
    public function getStyle()
    {
        return $this->hasOne(MusicStyle::className(), ['id' => 'style_id']);
    }
}