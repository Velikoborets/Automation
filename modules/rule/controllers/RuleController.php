<?php

namespace app\modules\rule\controllers;

use Yii;
use yii\web\Controller;
use yii\db\StaleObjectException;
use app\modules\rule\models\Rule;
use app\modules\rule\models\RuleForm;

class RuleController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new RuleForm();

        try  {
            // Загружаем отпр. данные из POST и проводим валидацию по правилам модели RuleForm
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                // Массив с отправленными JSON-правилами
                $jsonConditions = Yii::$app->request->post('conditions-json');

                // Декодируем JSON строку обратно в массив
                $model->conditions = json_decode($jsonConditions, true);

                // Если все данные валидны, создаём новую модель Rule
                $rule = new Rule();

                // И записываем и проверяем, данные из модели RuleForm в модель Rule
                // Которые модель Rule ещё раз проверяет уже своей валидацией
                $rule->name = $model->name;
                $rule->conditions = json_encode($model->conditions); // Сохраняем условия как JSON строку.
                $rule->user_id = Yii::$app->user->id; // Вытаскиваем id авториз. user и пишем в user_id

                if ($rule->save()) {
                    Yii::$app->session->setFlash('success', 'Правило сохранено');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Не удалось сохранить правило! Ошибки: ' .
                        implode(', ', $rule->getFirstErrors()));
                }
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id): \yii\web\Response
    {
        $rule = $this->findModel($id);
        if ($rule->user_id === Yii::$app->user->id) {
            $rule->delete();
        }

        Yii::$app->session->setFlash('success', 'Правило удалено!');
        return $this->redirect(['index']);
    }

    /**
     * @throws \Exception
     */
    protected function findModel($id): Rule
    {
        // Вытаскиваем с помощью eloquent запросов, id правила из table rules.
        $model = Rule::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new \Exception('Данных юзера - не найдено!');
    }
}