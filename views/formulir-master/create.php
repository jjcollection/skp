<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormulirMaster */

$this->title = Yii::t('app', 'Formulir Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formulir Baru'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
