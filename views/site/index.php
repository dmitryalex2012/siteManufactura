<body class="home">
<?php
use yii\helpers\Html;
?>

<?php
/* @var $ourOffers object */
?>


<?php foreach ($ourOffers as $key=>$ourOffer):
?>
<div class="row">
    <div class="card text-white col-12 col-lg-6">
        <img src="foto\indexFoto\example4.jpg" class="card-img" alt="100%">
        <div class="card-img-overlay">
            <p class="pInIndex"><?php echo $ourOffer->inscription; ?></p>
            <?php echo Html::a('Выбрать модель', '/products/pillows', ['class'=>'indexBtn btn btn-outline-info']); ?>
        </div>
    </div>

    <div class="card text-white col-12 col-lg-6">
        <img src="foto\indexFoto\example4.jpg" class="card-img" alt="100%">
        <div class="card-img-overlay">
            <p class="pInIndex">Постельное белье</p>
            <?php echo Html::a('Выбрать модель', '/products/pillows', ['class'=>'indexBtn btn btn-outline-info']); ?>
        </div>
    </div>

    <div class="card text-white col-12 col-lg-6">
        <img src="foto\indexFoto\example4.jpg" class="card-img" alt="100%">
        <div class="card-img-overlay">
            <p class="pInIndex">Постельное белье</p>
            <?php echo Html::a('Выбрать модель', '/products/pillows', ['class'=>'indexBtn btn btn-outline-info']); ?>
        </div>
    </div>

    <div class="card text-white col-12 col-lg-6">
        <img src="foto\indexFoto\example4.jpg" class="card-img" alt="100%">
        <div class="card-img-overlay">
            <p class="pInIndex">Постельное белье</p>
            <?php echo Html::a('Выбрать модель', '/products/pillows', ['class'=>'indexBtn btn btn-outline-info']); ?>
        </div>
    </div>
</div>
<?php endforeach;
?>


<!--<h4>Индивидуальный дизайн и пошив штор</h4>-->
<!--<h4>Все типы жалюзей и ролет</h4>-->
<!--<h4>Стильные подушки</h4>-->
<!--<p class="pInIndex">Постельное белье</p>-->
<!--<p class="pInIndex">Клевые полотенца для всей семьи</p>-->
<!--<h4>Apero</h4>-->




<!--<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">-->
<!--    <ol class="carousel-indicators">-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>-->
<!--        <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>-->
<!--    </ol>-->
<!--    <div class="carousel-inner">-->
<!--        <div class="carousel-item active">-->
<!--            <img src="foto/servicesDelivery.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h4>Индивидуальный дизайн и пошив штор</h4>-->
<!--                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="foto/servicesDesignProgect.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h4>Все типы жалюзей и ролет</h4>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="foto/servicesTextileSelection.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h4>Стильные подушки</h4>-->
<!--                --><?php //echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--                <br> <br>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="foto\indexFoto\example4.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <p class="pInIndex">Постельное белье</p>-->
<!--                --><?php //echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="foto\indexFoto\example4.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <p class="pInIndex">Клевые полотенца для всей семьи</p>-->
<!--                --><?php //echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="foto/servicesDesignProgect.jpg" class="d-block w-100" alt="100%">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h4>Apero</h4>-->
<!--                --><?php //echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">-->
<!--        <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--        <span class="sr-only">Previous</span>-->
<!--    </a>-->
<!--    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">-->
<!--        <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--        <span class="sr-only">Next</span>-->
<!--    </a>-->
<!--</div>-->


<!--/services/list-->

<!--<a href="/products/list">-->
<!--    <button>To products page</button>-->
<!--</a>-->
