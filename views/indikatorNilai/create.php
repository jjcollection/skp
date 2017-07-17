<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IndikatorNilai */

$this->title = Yii::t('app', 'Create Indikator Nilai');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indikator Nilais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-nilai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
