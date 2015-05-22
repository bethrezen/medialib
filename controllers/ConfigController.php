<?php

namespace simplator\medialib\controllers;

use Yii;
use simplator\medialib\models\Config;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Config::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Config model.
     * @param string $model
     * @param string $item
     * @param string $variant
     * @return mixed
     */
    public function actionView($model, $item, $variant)
    {
        return $this->render('view', [
            'model' => $this->findModel($model, $item, $variant),
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'model' => $model->model, 'item' => $model->item, 'variant' => $model->variant]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $model
     * @param string $item
     * @param string $variant
     * @return mixed
     */
    public function actionUpdate($model, $item, $variant)
    {
        $model = $this->findModel($model, $item, $variant);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'model' => $model->model, 'item' => $model->item, 'variant' => $model->variant]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $model
     * @param string $item
     * @param string $variant
     * @return mixed
     */
    public function actionDelete($model, $item, $variant)
    {
        $this->findModel($model, $item, $variant)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $model
     * @param string $item
     * @param string $variant
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($model, $item, $variant)
    {
        if (($model = Config::findOne(['model' => $model, 'item' => $item, 'variant' => $variant])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
