<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'FIX Club';

?>
<div class="site-index">
    <div class="body-content">
        <div class="row top-club">
            <div class="col-md-1 col-sm-1 col-xs-1 left-wall cells">
                <button class="btn btn-success">Старт</button>
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
