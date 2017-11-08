<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Indikator */

$this->title = 'Create Indikator';
$this->params['breadcrumbs'][] = ['label' => 'Indikators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
