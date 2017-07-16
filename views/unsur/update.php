<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unsur */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Unsur',
]) . $model->IdUnsur;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unsurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IdUnsur, 'url' => ['view', 'id' => $model->IdUnsur]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="unsur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
