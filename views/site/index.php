<body class="home">
<?php
use yii\helpers\Html;
?>

<h1>This page is not ready yet.</h1>
<?php
echo Html::a('Перейти', '/products/pillows', ['class'=>'btn btn-lg btn-primary']);
echo "<br>";
?>
<!--/services/list-->

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Название карточки</h5>
        <?php echo HTML::a('Detail', '/products/pillows', ['class'=>'myBtn btn-lg btn-primary']); echo "<br>"; echo "<br>"; ?>
        <?php echo Html::a('Перейти', '/products/pillows', ['class'=>'btn btn-lg btn-primary']); ?>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
<!--        <a href="#" class="btn btn-primary">Переход куда-нибудь</a>-->
    </div>
    <img src="foto/servicesDesignerСall.jpg" class="card-img-top" alt="...">
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Название карточки</h5>-->
<!--        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--        <a href="#" class="btn btn-primary">Переход куда-нибудь</a>-->
<!--    </div>-->
</div>


<!--<a href="/products/list">-->
<!--    <button>To products page</button>-->
<!--</a>-->
