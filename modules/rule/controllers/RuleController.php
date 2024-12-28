<?php

namespace app\modules\rule\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\db\StaleObjectException;
use yii\data\ActiveDataProvider;
use app\modules\rule\models\Rule;
use app\modules\rule\models\Condition;

class RuleController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Rule::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $rule = new Rule();
            $rule->name = $data['name'];
            $rule->user_id = Yii::$app->user->id;

            if ($rule->save()) {
                if (isset($data['conditions']) && is_array($data['conditions'])) {
                    foreach ($data['conditions'] as $conditionData) {
                        $condition = new Condition();
                        $condition->rule_id = $rule->id;
                        $condition->field = $conditionData['field'];
                        $condition->operator = $conditionData['operator'];
                        $condition->value = $conditionData['value'];

                        // Валидируем условие перед сохранением и если всё ок - сохраняем в Б/Д
                        if (!$condition->validate()) {
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', 'Не удалось сохранить условие. Ошибки: ' . implode(', ', $condition->getFirstErrors()));
                            return $this->redirect(['create']);
                        } else {
                            $condition->save();
                        }
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Правило успешно сохранено.');
                return $this->redirect(['index']);
            }

            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Не удалось сохранить правило. Ошибка: ' . implode(', ', $rule->getFirstErrors()));
            return $this->redirect(['create']);
        }

        return $this->render('create');
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

    protected function findModel($id): Rule
    {
        $model = Rule::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new \Exception('Данных пользователя - не найдено!');
    }
}