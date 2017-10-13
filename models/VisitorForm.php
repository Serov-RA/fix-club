<?php

namespace app\models;

class VisitorForm extends Visitor
{
    /**
     * @var integer
     */
    public $quantity, $skills;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return get_parent_class()::tableName();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'quantity', 'skills'], 'required'],
            ['quantity', 'number', 'min'=> 1, 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sex' => 'Пол',
            'quantity' => 'Количество',
            'skills' => 'Умение танцевать',
        ];

    }

    /**
     * @access public
     *
     * Save all data
     */
    public function massSave()
    {
        $dancers = [];

        $session = Session::getCurrentSession();

        for ($i = 1; $i <= $this->quantity; $i++) {
            $visitor = new parent;
            $visitor->sid = $session->id;
            $visitor->sex = $this->sex;
            $visitor->save();
            $dancers[] = $visitor;

            foreach ($this->skills AS $style_id) {
                $skill = new Skill;
                $skill->visitor_id = $visitor->id;
                $skill->style_id = $style_id;
                $skill->save();
            }
        }

        return $this->getVisitors($dancers);
    }

   /**
     * @access public
     *
     * Get formatted dancers
     */
    public function getVisitors($pre_dancers)
    {
        $dancers = [];

        foreach ($pre_dancers AS $dancer) {
            $skills = [];

            foreach ($dancer->skills AS $skill) {
                $skills[$skill->style_id] = 1;

                if ($skill->style->parentStyle && !isset($skills[$skill->style->parentStyle->id])) {
                    $skills[$skill->style->parentStyle->id] = 1;
                }

                foreach ($skill->style->substyles AS $substyle) {
                    if (!isset($skills[$substyle->id])) {
                        $skills[$substyle->id] = 1;
                    }
                }
            }

            $dancers[$dancer->id] = [
                'sex' => $dancer->sex,
                'skills' => $skills,
                'action' => NULL,
                'view' => 0,
            ];
        }

        return $dancers;
    }

    /**
     * @access public
     *
     * Get saved playlist
     */
    public function getSavedDancers()
    {
        $dancers = Visitor::find()->where(['sid' => Session::getCurrentSession()])->all();
        return $this->getVisitors($dancers);
    }
}