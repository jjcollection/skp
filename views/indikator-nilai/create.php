<?php

use app\models\IndikatorNilai;
use yii\web\View;

/* @var $this View */
/* @var $model IndikatorNilai */

$this->title = 'Create Indikator Nilai';
$this->params['breadcrumbs'][] = ['label' => 'Indikator Nilais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikator-nilai-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
