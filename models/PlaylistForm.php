<?php

namespace app\models;

use yii\helpers\Html;

class PlaylistForm extends Playlist
{
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
            [['song_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'song_id' => 'Список композиций',
        ];

    }

    /**
     * @access public
     *
     * Save all data
     */
    public function savePlaylist()
    {
        $session = Session::getCurrentSession();
        $playlist = [];

        foreach ($this->song_id AS $song) {
            $playlist_song = new parent;
            $playlist_song->sid = $session->id;
            $playlist_song->song_id = $song;
            $playlist_song->save();
            $playlist[] = $playlist_song;
        }

        return $this->getPlaylist($playlist);
    }

    /**
     * @access public
     *
     * Get formatted playlist
     */
    public function getPlaylist($pre_playlist)
    {
        $playlist = [];

        foreach ($pre_playlist AS $record) {
            $movements = [];

            $style = $record->song->style;

            if ($style->parentStyle) {
                $style = $style->parentStyle;
            }

            foreach ($style->movements AS $movement) {
                $movements[] = Html::encode($movement->dance_movement);
            }

            $playlist[$record->song_id] = [
                'name' => Html::encode($record->song->song_name),
                'style' => $style->id,
                'is_play' => 0,
                'movements' => $movements,
            ];
        }

        return $playlist;
    }

    /**
     * @access public
     *
     * Get saved playlist
     */
    public function getSavedPlaylist()
    {
        $playlist = Playlist::find()->where(['sid' => Session::getCurrentSession()])->all();
        return $this->getPlaylist($playlist);
    }
}