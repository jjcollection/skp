<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kredit */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kredit',
]) . $model->No;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kredits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->No, 'url' => ['view', 'id' => $model->No]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kredit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
