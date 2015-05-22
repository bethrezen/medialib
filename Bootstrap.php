<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace simplator\medialib;

use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

/**
 * FIXME включить и проверить все модули, настроить исходя из их настроек
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('medialib') && ($module = $app->getModule('medialib')) instanceof Module)
		{

			$configUrlRule = [
				'prefix' => $module->urlPrefix,
				'rules'  => $module->urlRules
			];

			if ($module->urlPrefix != 'medialib') {
				$configUrlRule['routePrefix'] = 'medialib';
			}

			$app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);

            if (!isset($app->get('i18n')->translations['medialib*'])) {
                $app->get('i18n')->translations['medialib*'] = [
                    'class'    => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                ];
            }
/*
            $defaults = [
                'welcomeSubject'        => \Yii::t('user', 'Welcome to {0}', \Yii::$app->name),
                'confirmationSubject'   => \Yii::t('user', 'Confirm account on {0}', \Yii::$app->name),
                'reconfirmationSubject' => \Yii::t('user', 'Confirm email change on {0}', \Yii::$app->name),
                'recoverySubject'       => \Yii::t('user', 'Complete password reset on {0}', \Yii::$app->name)
            ];

            \Yii::$container->set('dektrium\user\Mailer', array_merge($defaults, $module->mailer));
*/
		}
        
    }
}