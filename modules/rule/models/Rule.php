<?php

namespace app\modules\rule\models;

use yii\db\ActiveRecord;
use app\modules\user\models\User;

/**
 * This is a model class for "rules" table
 *
 * @property int $id
 * @property int $user_id
 * @property string $conditions
 * @property string $name
 *
 * @property User $user
 */
class Rule extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'rules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'name', 'conditions'], 'required'],
            [['user_id'], 'integer'],
            [['conditions'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],

            // проверяет существ. ли user с указ. id  в табл. "users"
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id'],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return  [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'conditions' => 'Conditions',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     */
    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}