<?php

use yii\helpers\Html;
use app\modules\rule\models\Condition;

$this->title = 'Список правил';
$this->params['breadcrumbs'][] =  ['label' => 'Список правил', 'url' => 'index'];

// Запихаем эти полученные поля из model в скрытые input'ы
$fieldsData = json_encode(Condition::availableFields());
$operatorsData = json_encode(Condition::availableOperators());

?>

<h1>Rules</h1>

<?= Html::beginForm(['rule/create'], 'post', ['id' => 'rule-form']) ?>
<?= Html::textInput('name', '', ['placeholder' => 'Имя правила', 'class' => 'form-control form-control-sm', 'required' => true]) ?>
<br>

<div id="conditions">
    <div class="condition-wrapper" data-default-rule="true">
        <?= Html::dropDownList('conditions[0][field]', null, Condition::availableFields(), ['prompt' => 'Select a field', 'class' => 'form-control form-control-sm']) ?>
        <?= Html::dropDownList('conditions[0][operator]', null, Condition::availableOperators(), ['prompt' => 'Select an operator', 'class' => 'form-control form-control-sm']) ?>
        <?= Html::textInput('conditions[0][value]', '', ['placeholder' => 'Value', 'class' => 'form-control form-control-sm']) ?>
        <?= Html::button('+', ['class' => 'btn btn-success btn-sm', 'onclick' => 'createCondition()']) ?>
        <?= Html::button('-', ['class' => 'btn btn-danger btn-sm btn-m', 'onclick' => 'removeCondition(this);']) ?>
    </div>
</div>

<?= Html::hiddenInput('fields-data', $fieldsData, ['id' => 'fields-data']) ?>
<?= Html::hiddenInput('operators-data', $operatorsData, ['id' => 'operators-data']) ?>

<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?= Html::endForm() ?>
