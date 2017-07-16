<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormulirMaster */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Formulir Master',
]) . $model->idFormulirMaster;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formulir Masters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFormulirMaster, 'url' => ['view', 'id' => $model->idFormulirMaster]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="formulir-master-update">
     

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    

</div>
