<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--    <link href="css/list.css" rel="stylesheet">-->
<!--        <link href="css/shop.css" rel="stylesheet">-->

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
        'brandLabel' => '<img src="/foto/logo.jpg"; class="img-responsive">',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
//            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Услуги', 'url' => ['/services/list']],
            ['label' => 'Наши работы', 'url' => ['/site/works']],
//            ['label' => 'Магазин', 'url' => ['/products/list']],
            ['label' => 'Магазин', 'items' => [
                ['label' => 'Подушки', 'url' => ['/products/pillows']],
                ['label' => 'Постельное белье', 'url' => ['/products/linens']],
                ['label' => 'Полотенца', 'url' => ['/products/towels']],
                ['label' => 'Товары ТМ "Apero"', 'url' => ['/products/apero']],
            ]],
            ['label' => 'Блог', 'url' => ['#']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            ['label' => 'Корзина', 'url' => ['/cart/index'], 'linkOptions' => ['class' => 'classCart']],
//            Yii::$app->user->isGuest ? (
//            ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
        ],
    ]);
    ?>


    <?php
    NavBar::end();
    ?>


<!--    <br>-->

    <div class="container">
<!--        --><?php //       echo "<br>";        echo "<br>";        echo "<br>";        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?php
$onLoad = <<<JS
    $(document).ready(function() {
         $.ajax({
            url: '/cart/total',
            // data: {productData: productData},
            // dataType : 'json',
            type: 'POST',
            success: function (totalQuantity) {              // array ("0"=>price, "1"=>difference)
                if (totalQuantity != 0) { $('.classCart').html("Корзина "+totalQuantity); }
             },
            error: function () {
                console.log ("Failed");            //  NEED !!!!!!!!!!  better delete???????
            }
        })   
    });
JS;
$this->registerJs($onLoad);
?>


<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="containerLogo col-sm-7 col-12">
                <p>&copy; Дизайн-бюро "Мануфактура" 2012-2020</p>
            </div>
            <div class="containerRef col-sm-5 col-12">
                <a href="https://www.facebook.com/kievshtoranazakaz/" target="_blank"><img src="/foto/facebook1.png" alt=""/></a>
                <a href="https://www.instagram.com/kievshtoranazakaz/" target="_blank"><img src="/foto/inst1.png" alt=""/></a>
            </div>
        </div>
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
<?php $this->endPage() ?>
