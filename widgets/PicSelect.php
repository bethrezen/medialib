<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cnxfaeton\medialib\widgets;

use cnxfaeton\medialib\models\Picture;

/**
 * Description of PicSelect
 *
 * @author faeton
 */
class PicSelect extends \yii\jui\InputWidget
{
    public function run()
    {
        $model  = \Yii::createObject(Picture::className());
        $action = $this->validate ? null : ['/user/security/login'];

        if ($this->validate && $model->load(\Yii::$app->request->post()) && $model->login()) {
            return \Yii::$app->response->redirect(\Yii::$app->user->returnUrl);
        }

        return $this->render('login', [
            'model'  => $model,
            'action' => $action
        ]);
    }
}
