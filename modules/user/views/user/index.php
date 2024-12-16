<?php

use yii\helpers\Html;

$this->title = 'Автоматизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Yii::$app->session->getFlash('success') ?>

<h2><?= Html::encode($this->title) ?></h2>

<?= Html::a('Управление правилами', ['/rules'], ['class' => 'btn btn-success']) ?>