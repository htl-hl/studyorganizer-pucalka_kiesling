<?php

use app\models\Homework;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\HomeworkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Homeworks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Homework'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'homeworkId',
            'title',
                [
                        'attribute' => 'description',
                        'format' => 'ntext',
                        'value' => function ($model) {
                            return mb_strimwidth($model->description, 0, 40, "...");
                        },
                ],
            'due_date',
            'is_done:boolean',
            //'userId',
            //'subejctId',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Homework $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'homeworkId' => $model->homeworkId]);
                 }
            ],
        ],
    ]); ?>


</div>
