<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Homework $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Homeworks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="homework-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'homeworkId' => $model->homeworkId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'homeworkId' => $model->homeworkId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Erledigt'), ['finish', 'id' => $model->homeworkId], [
                'class' => 'btn btn-success',
                'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to finish this task?'),
                        'method' => 'post',
                ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'homeworkId',
            'title',
            'description:ntext',
                [
                        'attribute' => 'userId',
                        'label' => 'Erstellt von',
                        'value' => function ($model) {
                            return $model->user ? $model->user->username : '(Nicht gesetzt)';
                        },
                ],
                [
                        'attribute' => 'is_done',
                        'label' => 'Erledigt',
                        'format' => 'boolean',
                ],
                [
                        'attribute' => 'subjectId',
                        'label' => 'Fach',
                        'value' => function ($model) {
                            return $model->subject ? $model->subject->name : '(nicht gesetzt)';
                        },
                ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
