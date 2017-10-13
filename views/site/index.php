<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'FIX Club';

?>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_window">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="site-index">
    <div class="buttons text-center">
        <button class="btn btn-success add-dancers">Добавить персонажей</button>
        <button class="btn btn-success add-songs">Добавить плейлист</button>
    </div>
    <div class="player text-center" style="display: none">
        <button class="btn btn-success prev-song"><span class="glyphicon glyphicon-fast-backward"></span></button>
        <span class="now-play"></span>
        <button class="btn btn-success next-song"><span class="glyphicon glyphicon-fast-forward"></span></button>
        &nbsp;&nbsp;
        <a href="/site/new_session" class="btn btn-danger">Начать заново</a>
    </div>
    <div class="body-content">
        <div class="row top-club">
            <div class="col-md-1 col-sm-1 col-xs-1 left-wall cells">
                <?= Html::img('/images/female-dancer.png') ?>
                <?= Html::img('/images/male-dancer.png') ?>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10 dancezone cells">

            </div>
            <div class="col-md-1 col-sm-1 col-xs-1 right-wall cells">

            </div>
        </div>
        <div class="row bottom-club">
            <div class="col-md-1 col-sm-1 col-xs-1 club-door cells">
                <?= Html::img('/images/security.png') ?>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10 dancezone cells">

            </div>
            <div class="col-md-1 col-sm-1 col-xs-1 right-wall cells">
                <?= Html::img('/images/barman.png') ?>
            </div>
        </div>
    </div>
</div>
