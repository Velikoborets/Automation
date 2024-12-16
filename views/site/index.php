<?php

use yii\helpers\Html;

$this->title = 'Главная страница';
$this->params['breadcrumbs'][] = $this->title;

?>

<h2><?= Html::encode($this->title) ?></h2>

<?= Html::a('Авторизоваться', ['/login'], ['class' => 'btn btn-success']);