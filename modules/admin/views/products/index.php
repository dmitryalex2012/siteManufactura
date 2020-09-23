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

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success btnAdmin']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'categories',
            'categoriesBredCrumbs',
            'title',
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

            [   'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:20%; text-align:center;'],
                'contentOptions' => ['style' => 'padding:20px 0 0;'],

                'template' => '{view} {update} {delete} {copy}',






                'buttons' => [
                    'copy' => function ($url, $model, $key) {

                        //Текст в title ссылки, что виден при наведении
//                        $title = \Yii::t('yii', 'Copy');
                        $title = Yii::t('yii', 'Copy');

//                        $id = 'info-'.$key;
                        $options = [
                            'title' => $title,
                            'aria-label' => $title,
                            'data-pjax' => '0',
//                            'id' => $id
                        ];

                        //Для стилизации используем библиотеку иконок Bootstrap
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-duplicate"]);

                        $url = Url::current(['', 'id' => $key]);

//                        https://coderius.biz.ua/blog/article/kak-sozdat-svou-knopku-v-gridview-yii2


                        //Обработка клика на кнопку
//                        $js = <<<JS
//                           $("#{$id}").on("click",function(event){
//                                   event.preventDefault();
//                                   var myModal = $("#myModal");
//                                   var modalBody = myModal.find('.modal-body');
//                                   var modalTitle = myModal.find('.modal-header');
//
//                                   modalTitle.find('h2').html('Информация.');
//                                   modalBody.html('Тут будет информация.');
//
//                                   myModal.modal("show");
//                               }
//                           );
//JS;
                        //Регистрируем скрипты
//                        $this->registerJs($js, \yii\web\View::POS_READY, $id);


                        // save new purchase type in DB
                        $purchaseTypeJS = <<<JS
                        // $("#1").on("click",function() {
                        $("#info-1").on("click",function() {
                            // let purchaseTypeJS = ($(this).val());
                             $.ajax({
                                url: '/admin/products/copy',
                                // data: {purchaseTypeJS: purchaseTypeJS},
                                type: 'POST',
                                success: function (purchaseType) {
                                    // $('.purchaseTypeInTable').html("Способ оплаты: "+ purchaseType);   <!-- out new purchase type in table for customer -->
                                    console.log(purchaseType);
                                 },
                                error: function () {
                                    console.log ("Failed");
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
