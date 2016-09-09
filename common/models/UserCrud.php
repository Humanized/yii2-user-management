<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace humanized\usermanagement\common\models;

use Yii;
use yii\base\Model;

/**
 * Generic CRUD Operations for IdentityClass
 */
class UserCrud extends Model
{

    public static function create($attributes)
    {
        $userClass = \Yii::$app->user->identityClass;
        $model = new $userClass();

        if (!isset($attributes['email'])) {
            return null;
        }
        $test = $userClass::find()->where(['email' => $attributes['email']])->one();
        if (!isset($test)) {
            if (!isset($attributes['username'])) {
                $attributes['username'] = uniqid('user_');
            }
            if (!isset($attributes['password'])) {
                $attributes['password'] = Yii::$app->security->generateRandomString();
                $attributes['status'] = 0;
            }
            self::setup($model, $attributes);
            return $model->save() ? $model : null;
        }
        return null;
    }

    public static function setup($model, &$attributes)
    {

        $model->username = $attributes['username'];
        $model->email = $attributes['email'];
        $model->setPassword($attributes['password']);
        $model->generateAuthKey();
    }

    public static function readOne($id)
    {
        return self::read(['id' => $id]);
    }

    public static function readAll($condition)
    {
        return self::read($condition, true);
    }

    public static function read($condition, $all = false)
    {
        $userClass = \Yii::$app->user->identityClass;
        $query = $userClass::find()->where($condition);
        return $all ? $query->all() : $query->one();
    }

    public static function update($id, $attributes)
    {
        $userClass = \Yii::$app->user->identityClass;
        $model = $userClass::findOne($id);
        if (isset($model)) {
            $model->setAttributes($attributes);
            return $model->save();
        }
        return false;
    }

    public static function delete($attributes)
    {
        $userClass = \Yii::$app->user->identityClass;
        $model = $userClass::findOne($id);
        if (isset($model)) {
            $model->setAttributes($attributes);
            return $model->delete();
        }
        return false;
    }

}
