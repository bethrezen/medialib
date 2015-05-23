<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var simplator\medialib\models\Picture $picture
 */
?>

<div style="background: grey" id="<?php echo $id.'-select' ?>">
PicSelect
<?php echo Html::buttonInput(Yii::t('medialib', 'Select picture')) ?><br />
<?php echo $input ?>
</div>
