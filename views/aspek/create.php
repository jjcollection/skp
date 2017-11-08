<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aspek */

$this->title = 'Create Aspek';
$this->params['breadcrumbs'][] = ['label' => 'Aspeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
