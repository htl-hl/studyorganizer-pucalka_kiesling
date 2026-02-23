<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Teacher;

/** @var yii\web\View $this */
/** @var app\models\Subject $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacherId')->dropDownList(
    // Wir holen alle Fächer und mappen 'id' auf 'name'
            ArrayHelper::map(Teacher::find()->all(), 'teacherId', 'name'),
            [
                    'prompt' => 'Bitte ein Fach auswählen...', // Platzhalter
                    'class' => 'form-control' // Bootstrap-Klasse
            ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
