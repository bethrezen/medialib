<?php

/**
 * @copyright Copyright (c) 2015 Evgeny Lubyanoi
 * @license https://github.com/simplator/medialib/blob/master/LICENSE.md
 * @author Evgeny Lubyanoi <i@cnx-faeton.ru>
 */

namespace simplator\medialib\models;

use Yii;
use yii\helpers\Url;

class File extends \yii\base\Model
{
	public function __construct($model)
	{
	}
	
	public static function picture($id, $size='preview', $default=null)
	{
		if (!$id)
			if (is_integer($default))
				$id=$default;
			else
				$id=Yii::$app->settings->get($default);
		if (!$id)
			$id=Yii::$app->settings->get('medialib.default.id');
			
		return Url::to(['/medialib/file/picture', 'id'=>$id, 'size'=>$size]);
	}
}
