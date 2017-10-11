<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dance_movement`.
 * Has foreign keys to the tables:
 *
 * - `music_style`
 */
class m171011_150008_create_dance_movement_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dance_movement', [
            'id' => $this->primaryKey(),
            'style_id' => $this->integer()->defaultValue(NULL),
            'dance_movement' => $this->string()->notNull()->defaultValue(''),
        ]);

        // creates index for column `style_id`
        $this->createIndex(
            'idx-dance_movement-style_id',
            'dance_movement',
            'style_id'
        );

        // add foreign key for table `music_style`
        $this->addForeignKey(
            'fk-dance_movement-style_id',
            'dance_movement',
            'style_id',
            'music_style',
            'id',
            'CASCADE'
        );

        $movements = [
            1 => [
                'Покачивает туловищем вперед-назад',
                'Слабые движения головой',
                'Двигает руками по кругу',
                'Двигает ногами в ритме',
            ],
            2 => [
                'Покачивает телом вперед-назад',
                'Ноги в полуприсяде',
                'Руки согнуты в локтях',
                'Качает головой вперёд-назад',
            ],
            3 => [
                'Плавно двигает ногами',
                'Плавно двигает руками',
                'Плавно двигает головой',
                'Плавно двигает телом',
            ],
        ];

        foreach ($movements AS $style_id => $movement_list) {
            foreach ($movement_list AS $movement) {
                $this->insert('dance_movement', ['style_id' => $style_id, 'dance_movement' => $movement]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `music_style`
        $this->dropForeignKey(
            'fk-dance_movement-style_id',
            'dance_movement'
        );

        // drops index for column `style_id`
        $this->dropIndex(
            'idx-dance_movement-style_id',
            'dance_movement'
        );

        $this->dropTable('dance_movement');
    }
}
