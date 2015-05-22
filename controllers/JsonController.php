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
class JsonController extends Controller
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
     * Lists all Picture models.
     * @return mixed
     */
    public function actionCatalog($id=0)
    {
		header('Content-Type: application/json');
		$list=[
			[
				'title'=>'One of many roots catalogs',
				'id'=>3,
				'items'=>
				[
					[
						'title'=>'one catalog',
						'id'=>5
					],
					[
						'title'=>'sub catalog',
						'id'=>8,
						'items'=>
						[
							['title'=>'other catalog', 'id'=>4]
						]
					]
				]
			],
			[
				'title'=>'one catalog',
				'id'=>4
			],
		];
		return json_encode($list);
	}
	
    public function actionItems($catid=0)
    {
		$catid=intval($catid);
		$pics=Picture::find()->all();
		$items=[];
		foreach ($pics as $p)
			$items[]=[
				'id'	=> $p->id,
				'title'	=> $p->comment,
				'img'	=> $p->url('preview'),
				'size'	=> $p->sizex.'x'.$p->sizey
			];
		
		header('Content-Type: application/json');
		$list=[
			'title'=>'Title of selected catalog #'.$catid,
			'more'=>'About of catalog',
			'id'=>$catid,
			'items'=>$items
		];
		return json_encode($list);
	}
	
	public function actionIndex()
	{
        return $this->renderPartial('index', [
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
				echo '{}';
				return;
			}
			print_r($model->errors);
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
