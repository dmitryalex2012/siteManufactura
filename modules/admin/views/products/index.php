<?php

use yii\helpers\Html;
use yii\grid\GridView;


use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?= Html::a('Create new Product', ['create'], ['class' => 'btn btn-success btnAdmin']) ?>  </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'categories',
//            'categoriesBredCrumbs',
            'title',
            [
                'attribute' => 'address',
                'headerOptions' => ['style' => 'width:30%; text-align:center;'],
//                'contentOptions' => ['style' => 'min-width:400px; max-width:480px;'],
            ],
            'content',
//            'description',
            'size',
            'number',
            'price',

            [   'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:20%; text-align:center;'],
                'contentOptions' => ['style' => 'padding:20px 0 0;'],

                // add "Copy" button
                'template' => '{view} {update} {delete} {copy}',
                'buttons' => [
                    'copy' => function ($url, $model, $key) {
                        //Текст в title ссылки, что виден при наведении
                        $title = Yii::t('yii', 'Copy');

                        // button ID
                        $id = 'info-'.$key;

                        $options = [
                            'title' => $title,
                            'id' => $id
                        ];

                        //Для стилизации используем библиотеку иконок Bootstrap
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-duplicate"]);

                        // button URL
                        $url = Url::current(['', 'id' => $key]);

                        // "Copy" button click handling
                        $purchaseTypeJS = <<<JS

                        $("#{$id}").on("click",function() {
                             $.ajax({
                                url: '/admin/products/copy',
                                data: {idCopedString: "{$key}"},
                                type: 'POST',
                                success: function (purchaseType) {
                                    console.log(purchaseType);
                                    // alert(purchaseType);
                                    // alert(purchaseType);
                                 },
                                error: function () {
                                    console.log ("Failed");
                                    // alert(temp);
                                }
                            });
                        })
JS;
                        $this->registerJs($purchaseTypeJS);

                        return Html::a($icon, $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
