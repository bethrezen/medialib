<?php

namespace simplator\medialib\controllers;

use Yii;
use simplator\medialib\models\Picture;
use simplator\medialib\models\Config;
use simplator\medialib\models\Options;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * PictureController implements the CRUD actions for Picture model.
 */
class PictureController extends Controller
{
	public $enableCsrfValidation = false;
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
     * Lists all Picture models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Picture::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Picture models.
     * @return mixed
     */
    public function actionJson()
    {
        $all=Picture::find()->all();
		
		$ret=[];
		foreach ($all as $img)
			$ret['images'][]=[
				'preview'=>$img->url('preview'),
				'url'=>$img->url('full'),
				'title'=>$img->name
			];
		echo json_encode($ret);
    }

    /**
     * Displays a single Picture model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Picture model.
     * @param integer $id
     * @return mixed
     */
    public function actionImg($id, $size='full')
    {
        $model=$this->findModel($id);
		if (!$model)
			$model=$this->findModel(0);
		$this->redirect($model->directlink($size), 301);
    }

    /**
     * Creates a new Picture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Picture();

		echo "<br><br><br><br><br><br>";
		var_dump($_FILES);
		
        if (Yii::$app->request->isPost)
		{
			$model->file = UploadedFile::getInstance($model, 'file');
			if ($model->file) $model->upload();
			
			if ($model->load(Yii::$app->request->post()) && $model->save())
				return $this->redirect(['view', 'id' => $model->id]);
	    } 
		return $this->render('create', [
			'model' => $model,
		]);
    }

    /**
     * Creates a new Picture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpload()
    {
        $model = new Picture();

		if (Yii::$app->request->isPost)
		{
			$model->file = UploadedFile::getInstance($model, 'file');
			if ($model->file) $model->upload();
			
			if ($model->save())
			{
				echo json_encode(['success'=>true]);
				return;
			}
			$err='';
			$errs=$model->errors;
			//var_dump($errs); die();
			foreach ($errs as $n=>$v)
				$err.="$n:$v[0]; ";
			echo json_encode(['success'=>false, 'error'=>$err]);
//			print_r($model->errors);
			die();
				//return $this->redirect(['view', 'id' => $model->id]);
	    }
		return $this->render('create', [
			'model' => $model,
		]);
    }

    /**
     * Updates an existing Picture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			//echo "<img src='/upload/{$model->folder}/{$model->name}-preview.png'/>";
			
			return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Picture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionConfig($section='main')
    {
		new Config();
		$options=new Options('picture');
		print_r($_POST);
        return $this->render('config', [
			'options' => $options,
		]);
    }

    /**
     * Deletes an existing Picture model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Picture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Picture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Picture::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
