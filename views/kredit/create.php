<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kredit */

$this->title = Yii::t('app', 'Create Kredit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kredits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kredit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
