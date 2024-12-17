<?php

use yii\helpers\Html;

$this->title = 'Список правил';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => '/user'];

?>


<h2>Управление правилами</h2>

<?=Html::a('Создать правило', '/create', ['class' => 'btn btn-primary']) ?>

<p>Таблица Созданных правил</p>

