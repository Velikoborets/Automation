<?php

namespace app\modules\rule\controllers;

use yii\base\Controller;

class RuleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }
}