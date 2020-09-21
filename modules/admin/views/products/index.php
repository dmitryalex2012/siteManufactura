<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'categories',
            'categoriesBredCrumbs',
            'title',
//            'address',

            [
                'attribute' => 'address',
                'headerOptions' => ['style' => 'width:30%; text-align:center;'],
//                'contentOptions' => ['style' => 'min-width:400px; max-width:480px;'],
            ],

            'content',
            'description',
            'size',
            'number',
            'price',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:15%; text-align:center;']],
        ],
    ]); ?>


</div>
