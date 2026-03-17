<?php

namespace app\controllers;

use app\models\Homework;
use app\models\HomeworkSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * HomeworkController implements the CRUD actions for Homework model.
 */
class HomeworkController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Homework models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HomeworkSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionFinish($id)
    {
        $model = $this->findModel($id);

        $model->is_done = 1;

        $model->created_at = date("y-m-d");

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Task finished!');
        } else {
            Yii::$app->session->setFlash('error', 'Error saving task.');
        }

        return $this->redirect(['/']);
    }

    /**
     * Displays a single Homework model.
     * @param int $homeworkId Homework ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($homeworkId)
    {
        return $this->render('view', [
            'model' => $this->findModel($homeworkId),
        ]);
    }

    /**
     * Creates a new Homework model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Homework();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->userId = Yii::$app->user->id;

                $model->created_at = date("y-m-d");

                if ($model->save()) {
                    return $this->redirect(['/']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Homework model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $homeworkId Homework ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($homeworkId)
    {
        $model = $this->findModel($homeworkId);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->userId = Yii::$app->user->id;

                $model->updated_at = date("y-m-d");

                if ($model->save()) {
                    return $this->redirect(['/']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Homework model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $homeworkId Homework ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($homeworkId)
    {
        $this->findModel($homeworkId)->delete();

        return $this->redirect(['/']);
    }

    /**
     * Finds the Homework model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $homeworkId Homework ID
     * @return Homework the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($homeworkId)
    {
        if (($model = Homework::findOne(['homeworkId' => $homeworkId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
