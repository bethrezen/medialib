<?php

/**
 * @copyright Copyright (c) 2015 Evgeny Lubyanoi
 * @license https://github.com/simplator/medialib/blob/master/LICENSE.md
 * @author Evgeny Lubyanoi <i@cnx-faeton.ru>
 */

namespace simplator\medialib\models;

use Yii;

class Options extends \yii\base\Model
{
	protected $_model;

	protected $_values;
	public $items;
	
	
	
	public function __construct($model)
	{
		$this->load($model);
	}
	
	public function load($model)
	{
		/*$c=new Config;
		$c->model='picture';
		$c->item='size';
		$c->variant='small';
		$c->value=serialize([
			'width'=>256,
			'height'=>256,
			'scale'=>'out'
		]);*/
		if (!$c->save())
			print_r($c->errors);
		
		$values=Config::find()->where(['model'=>$model])->all();
		foreach ($values as $o)
		{
			$this->_values[$o->item][$o->variant]=$o;
			$this->items[$o->item][$o->variant]=unserialize($o->value);
		}
	}
	
	public function saveOptions()
	{
		foreach ($this->items as $opt=>$optval)
		{
			foreach ($optval as $variant=>$value)
			{
				if (!isset($this->_values[$opt][$variant]))
				{
					$conf=new Config;
					$this->_values[$opt][$variant]=$conf;
				}
				$conf=&$this->_values[$opt][$variant];
				$conf->model=$this->_model;
				$conf->item=$opt;
				$conf->variant=$variant;
				$conf->value=$value;
				$conf->save();
			}
		}
	}

	public function getModel()
	{
		return $this->_model;
	}
};

/**
 * This is the model class for table "{{%mlconfig}}".
 *
 * @property string $model
 * @property string $item
 * @property string $variant
 * @property integer $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%medialib_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'item', 'variant', 'value'], 'required'],
            [['model'], 'string'],
            [['value'], 'string'],
            [['item', 'variant'], 'string', 'max' => 25],
            [['model', 'item', 'variant'], 'unique', 'targetAttribute' => ['model', 'item', 'variant'], 'message' => 'The combination of Model, Item and Variant has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'model' => Yii::t('app', 'Model'),
            'item' => Yii::t('app', 'Item'),
            'variant' => Yii::t('app', 'Variant'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
