<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

use yii\helpers\Html;
?>
<div class="site-index">

    <div class="body-content">

        <?php

        /** @var yii\web\View $this */

        $this->title = 'Dashboard';

        use yii\grid\GridView;
        use yii\bootstrap5\ButtonDropdown;
        ?>
        <div class="site-index">
            <div class="body-content">
                <p>
                    <?php
                    echo ButtonDropdown::widget([
                            'label' => 'Hinzufügen',
                            'dropdown' => [
                                    'items' => [
                                            ['label' => 'Aufgabe', 'url' => 'homework/create'],
                                            ['label' => 'Subject', 'url' => 'subject/create'],
                                            ['label' => 'Teacher', 'url' => 'teacher/create'],
                                    ],
                            ],
                            'options' => ['class' => 'btn btn-primary'],
                    ]);
                    ?>
                </p>
                <div class="table-responsive" style="padding: 2cm">

                    <?= GridView::widget([
                            'dataProvider' => new \yii\data\ActiveDataProvider([
                                'query' => \app\models\Homework::find(),
                                'pagination' => ['pageSize' => 10],
                            ]),

                            'tableOptions' => ['class' => 'table table-striped table-bordered'],
                            'rowOptions' => function ($model, $key, $index, $grid) {
                                return [
                                        'style' => 'cursor: pointer',
                                        'onclick' => 'location.href="' . \yii\helpers\Url::to(['homework/view', 'homeworkId' => $model->homeworkId]) . '"',
                                ];
                            },
                            'headerRowOptions' => ['class' => 'table-primary'],
                            'summary' => '',
                            'emptyText' => 'Keine Daten vorhanden',
                            'columns' => [
                                    'title',
                                    [
                                            'attribute' => 'subject_id',
                                            'label' => 'Fach',
                                            'value' => function ($model) {
                                                return $model->subject ? $model->subject->name : 'Kein Fach';
                                            },
                                    ],
                                    [
                                            'label' => 'Lehrer',
                                            'value' => function ($model) {
                                                if ($model->subject && $model->subject->teacher) {
                                                    return $model->subject->teacher->name;
                                                }
                                                return 'no input';
                                            },
                                    ],
                                    'is_done:boolean',
                                    [
                                            'attribute' => 'due_date',
                                            'label' => 'Fälligkeitsdatum',
                                            'format' => ['date', 'php:d.m.Y'],
                                            'contentOptions' => function ($model) {
                                                if (!$model->due_date) {
                                                    return [];
                                                }

                                                $heute = new DateTime('today');
                                                $ziel = new DateTime($model->due_date);
                                                $differenz = $heute->diff($ziel);
                                                $tageBisDahin = (int)$differenz->format("%r%a");

                                                if ($tageBisDahin < 1) {
                                                    return ['style' => 'background-color: #f8d7da; color: #721c24; font-weight: bold;'];
                                                }
                                                elseif ($tageBisDahin < 7) {
                                                    return ['style' => 'background-color: #fff3cd; color: #856404; font-weight: bold;'];
                                                }
                                                elseif ($tageBisDahin <= 14) {
                                                    return ['style' => 'background-color: #d1ecf1; color: #0c5460;'];
                                                }

                                                return [];
                                            },
                                    ]
                            ],
                    ]); ?>

                </div>
            </div>
        </div>

    </div>
</div>
