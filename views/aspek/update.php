<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aspek */

$this->title = 'Update Aspek: ' . $model->idAspek;
$this->params['breadcrumbs'][] = ['label' => 'Aspeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAspek, 'url' => ['view', 'id' => $model->idAspek]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aspek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
