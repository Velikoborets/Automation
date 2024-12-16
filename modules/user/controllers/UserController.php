<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\user\models\User;

class UserController extends Controller
{
	/**
	 * Return the access control rules for index action.
	 *
	 * @return array the access control rules
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index'],
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * Display the login form and handles login logic
	 *
	 * @return string|Response and the rendered view for the index page or a redirect response.
	 */
	public function actionLogin()
	{
		$model = new User();

		if (Yii::$app->request->post()) {
            $username = Yii::$app->request->post('User')['username'];
			$user = User::findOne(['username' => $username]);

			if ($user !== null) {
				$success = Yii::$app->user->login($user);

                if ($success) {
                    Yii::$app->session->setFlash('success', 'Вы авторизованы!');
                }

				return $this->redirect(['index']);
			} else {
                Yii::$app->session->setFlash('error', 'Не верные данные!');
            }
		}

		return $this->render('login', ['model' => $model]);
	}

	/**
	 * Displays the user page if authenticated, otherwise redirects to the login page.
	 *
	 * @return yii\web\Response|string and the rendered view for the index page or a redirect response.
	 */
	public function actionIndex()
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect(['login']);
		}

		return $this->render('index');
	}
}