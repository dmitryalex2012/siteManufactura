<body class="home">
<?php
use yii\helpers\Html;
?>

<?php
/* @var $ourOffers string */
?>


<!--var_dump($ourOffers);-->


<div class="card bg-dark text-white">
    <img src="foto\indexFoto\example4.jpg" class="card-img" alt="100%">
    <div class="card-img-overlay">
<!--        <h5 class="card-title">Название карточки</h5>-->

        <p class="pInIndex">Постельное белье</p>
        <?php echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--        #myBtn {-->
<!--        color: green;-->
<!--        position: absolute;-->
<!--        bottom: 10px;-->
<!--        left: 45%;-->
<!--        }-->

<!--        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--        <p class="card-text">Last updated 3 mins ago</p>-->
    </div>
</div>


<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="foto/servicesDelivery.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <h4>Индивидуальный дизайн и пошив штор</h4>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
<!--                --><?php //echo Html::a('Детальнее', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
<!--                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>-->
            </div>
        </div>
        <div class="carousel-item">
            <img src="foto/servicesDesignProgect.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <h4>Все типы жалюзей и ролет</h4>
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
            </div>
        </div>
        <div class="carousel-item">
            <img src="foto/servicesTextileSelection.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <h4>Стильные подушки</h4>
                <!--                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>-->
                <?php echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
                <br> <br>
            </div>
        </div>
        <div class="carousel-item">
            <img src="foto\indexFoto\example4.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <p class="pInIndex">Постельное белье</p>
<!--                <h3>Постельное белье</h3>-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                <?php echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
            </div>
        </div>
        <div class="carousel-item">
            <img src="foto\indexFoto\example4.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <p class="pInIndex">Клевые полотенца для всей семьи</p>
                <!--                <h3>Постельное белье</h3>-->
                <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                <?php echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
            </div>
        </div>
        <div class="carousel-item">
            <img src="foto/servicesDesignProgect.jpg" class="d-block w-100" alt="100%">
            <div class="carousel-caption d-none d-md-block">
                <h4>Apero</h4>
                <!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                <?php echo Html::a('Выбрать модель', '/products/pillows', ['id'=>"myBtn", 'class'=>'btn btn-outline-info']); ?>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!--/services/list-->

<!--<a href="/products/list">-->
<!--    <button>To products page</button>-->
<!--</a>-->
