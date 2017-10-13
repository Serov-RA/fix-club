<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use app\models\VisitorForm;
use app\models\PlaylistForm;
use app\models\Session;
use app\models\Visitor;
use app\models\Playlist;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Get dancer form
     * @return string
     */
    public function actionDancer_form()
    {
        $model = new VisitorForm;
        $dancers = [];

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post()) && $model->validate()) {
            $dancers = $model->massSave();
        }

        return $this->renderAjax('dancer', ['model' => $model, 'dancers' => $dancers]);
    }

    /**
     * Get dancer form
     * @return string
     */
    public function actionPlaylist_form()
    {
        $playlist = [];

        if (!Visitor::find()->where(['sid' => Session::getCurrentSession()])->count()) {
            $model = false;
        } else {
            $model = new PlaylistForm;

            if (Yii::$app->request->post() && $model->load(Yii::$app->request->post()) && $model->validate()) {
                $playlist = $model->savePlaylist();
            }
        }

        return $this->renderAjax('playlist', ['model' => $model, 'playlist' => $playlist]);
    }

    /**
     * Get saved dancers
     */
    public function actionGet_visitors()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new VisitorForm;
        return $model->getSavedDancers();
    }

    /**
     * Get saved playlist
     */
    public function actionGet_playlist()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PlaylistForm;
        return $model->getSavedPlaylist();
    }

    /**
     * Select song
     */
    public function actionSelect_song()
    {
        $playlist = Playlist::find()->where(['sid' => Session::getCurrentSession()])->all();
        $post = Yii::$app->request->post();

        if ($post['currentSong'] == 0) {
            $select = $playlist[0];
        } else {
            $prev = $playlist[0];

            foreach ($playlist AS $idx => $song) {
                if ($song->song_id == $post['currentSong']) {
                    if ($post['direction'] == 'prev') {
                        $select = $prev;
                        break;
                    } else {
                        $select = (isset($playlist[$idx + 1]))?$playlist[$idx + 1]:$song;
                        break;
                    }

                    $prev = $song;
                }
            }
        }

        $select->play();
        return $select->song_id;
    }

    /**
     * Get new session
     */
    public function actionNew_session()
    {
        Playlist::deleteAll(['sid' => Session::getCurrentSession()]);
        Visitor::deleteAll(['sid' => Session::getCurrentSession()]);
        return $this->goHome();
    }
}