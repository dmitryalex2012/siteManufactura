<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Панель управления</title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
//            'brandLabel' => 'Панель управления',
//            'brandUrl' => Url::to(['/admin/default/index']),
//            'options' => [
//                'class' => 'navbar-inverse',
//            ],
        ]);
        echo Nav::widget([
//            'options' => ['class' => 'navbar-nav'],
            'options' => ['class' => 'navbar-navAdmin'],
            'items' => [
//                [
//                    'label' => 'Каталог',
//                    'items' => [
//                        ['label' => 'Категории', 'url' => ['/admin/products/index']],
//                        ['label' => 'Товары', 'url' => ['/admin/products/index']],

//                ['label' => 'Подушки',              'url' => ['/admin/products/index', 'value' => 'Pillow']],
//                ['label' => 'Постельное белье',     'url' => ['/admin/products/index', 'value' => 'linens']],
//                ['label' => 'Полотенца',            'url' => ['/admin/products/index', 'value' => 'towel']],
//                ['label' => 'Товары ТМ "Apero"',    'url' => ['/admin/products/index', 'value' => 'apero']],
//                ['label' => 'Товары для "бебиков"', 'url' => ['/admin/products/index', 'value' => 'baby']],

//                    ],
//                ],
                ['label' => 'Панель управления', 'url' => ['/admin/default/index']],
                ['label' => 'Работы', 'url' => ['/admin/works/index']],
                ['label' => 'Товары', 'url' => ['/admin/products/index']],

//                ['label' => 'Заказы', 'url' => ['/admin/products/index']],
//                ['label' => 'Пользователи', 'url' => ['/admin/user/index']],
//                ['label' => 'Страницы', 'url' => ['/admin/page/index']],

                ['label' => 'Выйти', 'url' => ['/admin/auth/logout']],

            ],
        ]);
        echo Nav::widget([
//            'options' => ['class' => 'navbar-nav navbar-right'],
//            'items' => [
//                ['label' => 'Выйти', 'url' => ['/admin/auth/logout']],
//            ],
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="containerAdmin">
        <div class="container">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => '/admin/default/index'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pLayoutsAdmin">&copy; <?= Yii::$app->params['shopName'] ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>