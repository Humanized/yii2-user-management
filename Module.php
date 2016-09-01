<?php

/**
 * @link https://github.com/humanized/yii2-user-management
 * @copyright Copyright (c) 2016 Humanized BV Comm V
 * @license https://github.com/humanized/yii2-user-management/LICENSE
 */

namespace humanized\usermanagement;

/**
 * Yii2 User Management Module
 * 
 * Provides several interfaces for dealing with user management 
 * 
 * 
 * @name Yii2 User Management
 * @version 0.1
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-user-management
 * 
 */
class Module extends \yii\base\Module
{

    public function init()
    {
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'humanized\usermanagement\commands';
        }
        parent::init();
    }

}
