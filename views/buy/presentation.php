<?php
/* @var $notes string */
/* @var $countTotal string */
/* @var $productAddress string */
?>
<!--<div id="content" class="wrap">-->

<!--<style>-->
<!--        width:100%;-->
<!--        height:100%;-->
<!--        background:url(../foto/backgroundPresentstion.jpg) center no-repeat;-->
<!--        background-size: cover;-->
<!--</style>-->

<div id="content" class="row">

<!--    <pre>-->
<!--        --><?php //var_dump($productAddress); ?>
<!--    </pre>-->

<!--    <div class="row">-->
        <div class="col-12 col-sm-8 col-md-8 text-center shadow-lg">
            <div class="product row">
                <div class="col-12 col-sm-2 col-md-1"></div>
                <div class="col-12 col-sm-8 col-md-10">
                    <h2>Device <?php echo $productAddress->id; ?></h2>
                    <a href="#" class="previous round"><<</a>
                    <a href="#" class="next round">>></a>
                    <img src="/<?php echo $productAddress->notes; ?>">
                </div>
                <div class="col-12 col-sm-2 col-md-1"></div>
            </div>
        </div>

        <div class="col-12 col-sm-4 col-md-4 text-center shadow-lg">
            <div class="sidebar">
                <ul>
                    <li>Width: 1m <br></li>
                    <li>High: 2m <br></li>
                    <li>Weight: 5kg <br></li>
                    <li>Made in: China</li>
                </ul>
            </div>
        </div>
<!--    </div>-->
</div>


<div class="price">
    <div class="row">
        <div class="col-12 col-sm-8 text-center shadow-lg">
            <p>9999 UAN</p>
            <a href="/products/list">
                <button>Buy</button>
            </a>
        </div>
<!--        <div class="col-12 col-sm-4 text-center shadow-lg">-->
<!--        </div>-->
    </div>
</div>


<!--<div id=footer>-->
<!--    <p>9999 UAN</p>-->
<!--    <a href="/products/list"><button>Buy</button></a>-->
<!--</div>-->