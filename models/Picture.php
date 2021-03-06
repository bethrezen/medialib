<?php

/**
 * @copyright Copyright (c) 2015 Evgeny Lubyanoi
 * @license https://github.com/simplator/medialib/blob/master/LICENSE.md
 * @author Evgeny Lubyanoi <i@cnx-faeton.ru>
 */

namespace simplator\medialib\models;

use Yii;

/**
 * This is the model class for table "{{%mlpicture}}".
 *
 * @property integer $id
 * @property string $folder
 * @property string $name
 * @property string $filetype
 * @property integer $sizex
 * @property integer $sizey
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $comment
 */
class Picture extends \yii\db\ActiveRecord
{
	public $file; ///< @property UploadedFile $file
	public static $_config=[
		'directory'=>'@webroot/upload',
		'webdir'=>'/upload',
		'size'=>[
			'full'=>[
				'w'	=>0,
				'h'=>0,
				'm'	=>'none'
			],
			'preview'=>[
				'w'=>128,
				'h'=>128,
				'm'=>'in',
				'f'=>'png'
			],
			'micro'=>[
				'w'=>32,
				'h'=>32,
				'm'=>'out',
				'f'=>'png'
			]
		]
	];
	
	/**
	 * Load picture by id
	 * 
	 * If picture not found returned default picture
	 * 
	 * Default picture 
	 * @param integer $id
	 * @param array|id|null $default
	 * @return \simplator\medialib\models\Picture
	 */
	public static function getPicture($id, $default='id')
	{
		$pic=Picture::find()->where(['id'=>$id])->one();
		if (!$pic)
			$pic=Picture::find()->where(['id'=>\Yii::$app->settings->get('default.'.$default, 'medialib')])->one();
		if (!$pic)
			$pic=Picture::find()->where(['id'=>\Yii::$app->settings->get('default.id', 'medialib')])->one();
		if (!$pic)
			$pic=new Picture();
		return $pic;
	}
	
	public function getConfig()
	{
		return self::$_config;
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%medialib_picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folder', 'name', 'filetype', 'sizex', 'sizey', 'createtime', 'updatetime'], 'required'],
            [['filetype'], 'string'],
            [['sizex', 'sizey', 'createtime', 'updatetime'], 'integer'],
            [['folder'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 32],
            [['comment'], 'string', 'max' => 250],
			[['folder', 'name', 'filetype'], 'unique', 'targetAttribute' => ['folder', 'name', 'filetype'], 'message' => 'The combination of Folder, Name and Filetype has already been taken.']
        ];
    }

	/**
	 * TODO если объект существует - то удалть старые изображения
	 * @return boolean
	 */
	public function upload()
	{
		if (!$this->file)
			return false;
		
		$info=getimagesize($this->file->tempName);
		
		if (!$info) return false;
		
		$this->filetype=substr($info['mime'], 6);
		$this->sizex=$info[0];
		$this->sizey=$info[1];
		$this->createtime=time();
		$this->updatetime=time();
		
		/// TODO: check for dublicates
		$exist=TRUE;
		while($exist)
		{
			$fn=md5(microtime(true));
			$this->folder=substr($fn, 0, 6);
			$this->name=substr($fn, 6);
			$exist=self::find()->where([
				'folder'=>$this->folder,
				'name'=>$this->name
			])->one();
		}
		
		if (!$this->save())
		{
			return false;
		}
	
		$fn=Yii::getAlias(self::$_config['directory']); @mkdir($fn);
		$fn.='/'.$this->folder; @mkdir($fn);
		$fn.='/'.$this->name.'.'.$this->filetype; 
		
		$this->file->saveAs($fn);
		
		// TODO: при необходимости удаление старых файлов
		// TODO: создание других размеров
		$this->createSizes();
		
		return true;
	}
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'folder' => Yii::t('app', 'Folder'),
            'name' => Yii::t('app', 'Name'),
            'filetype' => Yii::t('app', 'Filetype'),
            'sizex' => Yii::t('app', 'Sizex'),
            'sizey' => Yii::t('app', 'Sizey'),
            'createtime' => Yii::t('app', 'Createtime'),
            'updatetime' => Yii::t('app', 'Updatetime'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
	
	public function directlink($size='preview')
	{
		$fn=Yii::getAlias(self::$_config['webdir']);
		if ('full'==$size)
			return $fn.'/'.$this->folder.'/'.$this->name.'.'.$this->filetype;
		
		$postfix=$size=='full'?'':('-'.$size);
		
		if (!isset(self::$_config['size'][$size])) $size='preview';
		
		if (!isset(self::$_config['size'][$size]['f']))
			self::$_config['size'][$size]['f']='jpeg';
		
		$f=self::$_config['size'][$size]['f'];
		
		return $fn.'/'.$this->folder.'/'.$this->name.$postfix.'.'.$f;
	}
	
	public function url($size='preview')
	{
		if ($size=='full')
			return \yii\helpers\Url::to(['/medialib/picture/img', 'id'=>$this->id]);
		else
			return \yii\helpers\Url::to(['/medialib/picture/img', 'id'=>$this->id, 'size'=>$size]);
	}
	
	public function realpath($size='preview')
	{
		$fn=Yii::getAlias(self::$_config['directory']);
		if ('full'==$size)
			return $fn.'/'.$this->folder.'/'.$this->name.'.'.$this->filetype;
		
		$postfix=$size=='full'?'':('-'.$size);
		
		if (!isset(self::$_config['size'][$size])) $size='preview';
		
		if (!isset(self::$_config['size'][$size]['f']))
			self::$_config['size'][$size]['f']='jpeg';
		
		$f=self::$_config['size'][$size]['f'];
		
		return $fn.'/'.$this->folder.'/'.$this->name.$postfix.'.'.$f;
	}
	
	public function img($size='preview', $options=[])
	{
		$si=self::$_config['size'][$size];
		$options['w']=$si['w']?$si['w']:$this->sizex;
		$options['h']=$si['h']?$si['h']:$this->sizey;
		return \yii\helpers\Html::img($this->url($size), $options);
	}
	
	public function dropFiles()
	{
		// FIXME удаление файлов по маске
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord) return true;
		$this->dropFiles();
		$this->createSizes();
		return true;
	}
	
	// FIXME пересоздание вьюшек
	public function createSizes()
	{
		ini_set("memory_limit", -1);
		$fn=$this->realpath('full');
		$info=getimagesize($fn);
		$info['w']=$info[0];
		$info['h']=$info[1];
		switch($this->filetype)
		{
			case 'gif':  $input=imagecreatefromgif($fn); break;
			case 'jpeg': $input=imagecreatefromjpeg($fn); break;
			case 'png':  $input=imagecreatefrompng($fn); break;
		}
$ss=array();
		foreach (self::$_config['size'] as $name=>$size)
		{
			if ('full'==$name) continue;

			if (!isset($size['f']))
				$size['f']='jpeg';
		
			if ($size['w']==0 && $size['h']==0)
			{
				$size['w']=$info['w'];
				$size['h']=$info['h'];
			}
			
			$dst_x=0;
			$dst_y=0;
			$src_x=0;
			$src_y=0;

			$src_w=$info['w'];
			$src_h=$info['h'];
			$dst_w=$size['w'];
			$dst_h=$size['h'];

			if ($info['w']<$size['w'] && $info['h']<$size['h']) $size['m']='center';
			if (!isset($size['m']))
				$size['m']='in';
			
			$hc=$src_h/$dst_h;
			$wc=$src_w/$dst_w;
			
			switch ($size['m'])
			{
				case 'in':
					$k=max($hc, $wc);
					$dst_h=floor($info['h']/$k);
					$dst_w=floor($info['w']/$k);
					$dst_y=floor(($size['h']-$dst_h)/2);
					$dst_x=floor(($size['w']-$dst_w)/2);
					break;
				case 'out':
					$k=min($hc, $wc);
					$dst_h=floor($info['h']/$k);
					$dst_w=floor($info['w']/$k);
					$dst_y=floor(($size['h']-$dst_h)/2);
					$dst_x=floor(($size['w']-$dst_w)/2);
					break;
				case 'crop':
					$src_x=($info['w']-$size['w'])/2;
					$src_y=($info['h']-$size['h'])/2;
					
					$src_w=$size['w'];
					$src_h=$size['h'];
					break;
				case 'center':
					$src_x=0;
					$src_y=0;
					$src_w=$info['w'];
					$src_h=$info['h'];
					
					$dst_h=$info['h'];
					$dst_w=$info['w'];
					$dst_x=floor($size['w']-$info['w'])/2;
					$dst_y=floor($size['h']-$info['h'])/2;
					break;
				default: // scale
					break;
			}
			
			$image=  imagecreatetruecolor($size['w'], $size['h']);
			$transparent = imagecolorallocatealpha($image, 0, 0, 0, 127); 
			imagefill($image, 0, 0, $transparent); 

			imagealphablending($image, false);
			imagesavealpha($image, true);
			
			//imagepalettecopy($image, $input);
			imageinterlace($image, true);

			//imagecolortransparent($image, $trans);
			//imagefilledrectangle($image, 0, 0, $size['w'], $size['h'], $trans);
			//imagefilledrectangle($image, 0, 0, $size['w'], $size['h'], imagecolorallocatealpha($image, 255,55,55,5));
			imagecopyresampled($image, $input, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

			$fn=$this->realpath($name);
			@mkdir(dirname($fn));
			@mkdir(dirname(dirname($fn)));
			
			switch ($size['f'])
			{
				case 'gif':
					imagegif($image, $fn, 70);
				break;
				case 'png':
					imagepng($image, $fn, 0);
				break;
				case 'jpeg':
				default:
					imagejpeg($image, $fn, 70);
				break;
			}
			
			imagedestroy($image);
		}
		return true;
	}
}
