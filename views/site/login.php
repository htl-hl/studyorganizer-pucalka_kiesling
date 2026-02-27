<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login conatiner">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to login:</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                            'inputOptions' => ['class' => 'col-lg-3 form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                    <?= Html::button('Neues Konto erstellen', [
                            'class' => 'btn btn-primary',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#signup-modal',
                    ]); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <?php
            Modal::begin([
                    'title' => '<h4>Registrierung</h4>',
                    'id' => 'signup-modal',
                    'size' => 'modal-md',
            ]); ?>

            <p>Bitte wählen Sie einen Nutzernamen und ein Passwort:</p>

            <?php
            $signupModel = new \app\models\User();
            $signupForm = ActiveForm::begin([ // Neues Form-Objekt
                    'id' => 'signup-form',
                    'action' => ['site/signup'],
                    'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                    ],
            ]); ?>

            <?= $signupForm->field($signupModel, 'username')->textInput() ?>
            <?= $signupForm->field($signupModel, 'password')->passwordInput() ?>

            <div class="form-group mt-4">
                <?= Html::submitButton('Registrieren & Speichern', [
                        'class' => 'btn btn-success w-100',
                        'name' => 'signup-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <?php Modal::end(); ?>
        </div>
    </div>
</div>
