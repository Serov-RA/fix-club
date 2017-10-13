<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MusicStyle;

?>

<?php if ($dancers) { ?>
    <script type="text/javascript">
        var dancers = <?= json_encode($dancers) ?>;
        fixClub.setVisitors(dancers);
        $('.modal-footer .btn-primary').hide();
    </script>
    Персонажи добавлены!
<?php

    } else {
        $form = ActiveForm::begin();

?>

    <?= $form->field($model, 'sex')->dropdownList($model->allowed_sex); ?>

    <?= $form->field($model, 'quantity')->input('number', ['max' => 10, 'min' => 1]) ?>

    <?= $form->field($model, 'skills[]')->checkboxList(MusicStyle::find()->select(['style_name', 'id'])->indexBy('id')->column()); ?>

<?php

        ActiveForm::end();
    }
?>