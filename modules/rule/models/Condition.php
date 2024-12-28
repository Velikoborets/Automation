<?php

namespace app\modules\rule\models;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

class Condition extends ActiveRecord
{
    public const LESS_THAN = 0;
    public const MORE_THAN = 1;
    public const LESS_THAN_OR_EQUAL = 2;
    public const MORE_THAN_OR_EQUAL = 3;
    public const EQUAL = 4;

    public const ROI = 0;
    public const COST = 1;
    public const REVENUE = 2;

    public const APR = 3;

    public static function tableName()
    {
        return 'conditions';
    }

    public const AVAILABLE_OPERATORS = [
        self::LESS_THAN => '<',
        self::MORE_THAN => '>',
        self::LESS_THAN_OR_EQUAL => '<=',
        self::MORE_THAN_OR_EQUAL => '>=',
        self::EQUAL => '=',
    ];

    public static function availableFields(): array
    {
        return [
            self::ROI => 'ROI',
            self::COST => 'Cost',
            self::REVENUE => 'Revenue',
            self::APR => 'APR',
        ];
    }

    public static function availableOperators(): array
    {
        return self::AVAILABLE_OPERATORS;
    }

    public function rules()
    {
        return [
            [['rule_id', 'field', 'operator', 'value'], 'required'],
            [['rule_id', 'field', 'operator'], 'integer'],
            [['value'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rule_id' => 'Rule ID',
            'field' => 'Field',
            'operator' => 'Operator',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
