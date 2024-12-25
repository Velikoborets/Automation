<?php

namespace app\modules\rule\models;

use yii\base\Model;

class RuleForm extends Model
{
    public $name;
    public $conditions = [];

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['conditions'], 'safe'],
        ];
    }

/* Для вывода сущностей в представлении Yii\Widget (пока не надо)
    public function getEssences(): array
    {
        return [
            'clicks' => 'Clicks',
            'leads' => 'Leads',
            'profit' => 'Profit',
            'roi' => 'ROI',
        ];
    }

    public function getOperators(): array
    {
        return [
            '>' => '>',
            '<' => '<',
            '=' => '=',
            '=>' => '=>',
            '<=' => '<=',
        ];
    }
*/
}