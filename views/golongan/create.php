<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = Yii::t('app', 'Create Golongan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Golongans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
