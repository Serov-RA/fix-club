<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MusicSong;

?>

<?php if ($playlist) { ?>
    <script type="text/javascript">
        var playlist = <?= json_encode($playlist) ?>;
        fixClub.setPlaylist(playlist);
        $('.modal-footer .btn-primary').hide();
    </script>
    Плейлист сформирован!
<?php

    } elseif (!$model) {

?>

    Сначала добавьте посетителей!
    <script type="text/javascript">
        $('.modal-footer .btn-primary').hide();
    </script>
<?php

    } else {
        $form = ActiveForm::begin();

?>

    <?= $form->field($model, 'song_id[]')->checkboxList(MusicSong::find()->select(['song_name', 'id'])->indexBy('id')->column()); ?>

<?php

        ActiveForm::end();
    }
?>