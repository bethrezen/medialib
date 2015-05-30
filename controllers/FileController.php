<?php

namespace simplator\medialib\controllers;

use Yii;
use simplator\medialib\models\Picture;
use simplator\medialib\models\Config;
use simplator\medialib\models\Options;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * PictureController implements the CRUD actions for Picture model.
 */
class FileController extends Controller
{
    /**
     * Displays a single Picture model.
     * @param integer $id
     * @return mixed
     */
    public function actionPicture($id, $size='full')
    {
        if (($model = Picture::findOne($id)) === null)
		    throw new NotFoundHttpException('The requested page does not exist.');
        if (!$model)
			$model=new Picture();
		$this->redirect($model->directlink($size), 301);
    }
}
