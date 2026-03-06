<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Subject;

/** @var yii\web\View $this */
/** @var app\models\Homework $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="homework-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'due_date')->input('date') ?>

    <?= $form->field($model, 'is_done')->checkbox() ?>

    <?= $form->field($model, 'subjectId')->dropDownList(
    // Wir holen alle Fächer und mappen 'id' auf 'name'
            ArrayHelper::map(Subject::find()->all(), 'subjectId', function($model) {
                return $model->name . ' (' . $model->teacher->name . ')';
            }),
            [
                    'prompt' => 'Bitte ein Fach auswählen...',
                    'class' => 'form-control'
            ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
