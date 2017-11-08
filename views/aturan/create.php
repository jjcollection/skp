<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aturan */

$this->title = 'Create Aturan';
$this->params['breadcrumbs'][] = ['label' => 'Aturans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
