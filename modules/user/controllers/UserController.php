<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\user\models\User;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
	/**
	 * Display the login form and handles login logic
	 *
	 * @return string response
	 */
	public function actionLogin()
	{
		$model = new User();

		if (Yii::$app->request->post()) {
			$username = Yii::$app->request->post('username');
			$user = User::findOne(['username' => $username]);

			if ($user !== null) {
				Yii::$app->user->login($user);
				return $this->redirect(['automation/index']);
			}
		}

		return $this->render('login', ['model' => $model]);
	}

	/**
	 * Display the automation page
	 *
	 *  @return string
	 */
	public function actionIndex()
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect(['login']);
		}

		return $this->render('automation/index');
	}
}