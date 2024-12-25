<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rule\models\RuleForm */
/* @var $form yii\widgets\ActiveForm */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Правила</title>
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
    <h1 class="mb-4">Создание правил</h1>
        <?php $form = ActiveForm::begin(['action' => ['create'], 'method' => 'post',
        'options' => ['class' => 'rule-form']]) ?>
    <div class="form-group row align-items-center">
        <label for="name" class="col-sm-2 col-form-label">Имя правила</label>
        <div class="col-sm-4">
            <input class="form-control form-control-sm" name="RuleForm[name]" placeholder="Имя">
        </div>
    </div>
    <p>Условия</p>
    <div id="conditions" class="mb-3">
        <!-- Здесь будет динамически добавляемый контент -->
        <div class="condition-wrapper">
            <input class="form-control form-control-sm" name="Rule[conditions][0][key]" placeholder="Сущность">
            <select class="form-control form-control-sm" name="Rule[conditions][0][operator]">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select>
            <input class="form-control form-control-sm" name="Rule[conditions][0][value]" placeholder="Значение">
            <button type="button" class="btn btn-success btn-sm" onclick="createCondition()">+</button>
            <button type="button" class="btn btn-danger btn-sm btn-m">-</button>
        </div>
    </div>
    <!-- Скрытое поле для JSON-строки -->
    <input type="hidden" id="conditions-json" name="conditions-json">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>
