<?php
/* @var $title string */
/* @var $countTotal string */
/* @var $notes string */
?>

<?php //echo $title; ?><!--: --><?php //echo $countTotal; ?>


<?php //foreach ($items as $item): ?>
<!--<img src="/--><?php //echo $item->notes; ?><!--">-->
<?php //endforeach; ?>


<!--<ul class="list-group">-->
<!--    --><?php //foreach ($items as $item): ?>
<!--        <li class="list-group-item active">-->
<!--            <img src="/--><?php //echo $item->notes; ?><!--">-->
<!--            --><?php //echo $item->title; ?><!-- (-->
<!--            --><?php //echo $item->description; ?><!--)-->
<!--        </li>-->
<!---->
<!--    --><?php //endforeach; ?>
<!--    <li class="list-group-item">Morbi leo risus</li>-->
<!--    <li class="list-group-item">Porta ac consectetur ac</li>-->
<!--    <li class="list-group-item">Vestibulum at eros</li>-->
<!--</ul>-->


<hr>

<div class="products">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="sidebar">
                <ul>
                    <li><a href="#">Laptop</a></li>
                    <li><a href="#">Phones</a></li>
                    <li><a href="#">Memory</a></li>
                    <li><a href="#">Videocards</a></li>
                </ul>
            </div>
        </div>


        <div class="col-12 col-sm-9">
            <?php
            $arrayProducts = [];
            foreach ($items as $item):
                $arrayProducts[] = $item['notes'];
            endforeach;

            for ($i = 0; $i < (count($arrayProducts));) {
                ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 text-center shadow-lg">
                        <h3>Device-<?php echo $i + 1 ?></h3>
                        <img src="/<?php echo $arrayProducts[$i]; ?>" width="100%" class="col-10"><br>
                        <p> Width: 1m <br> High: 2m <br> Weight 5kg<br></p>
                        <!-- <a href="./feedback_form.html"><button>Buy</button></a> -->
                        <a href="./product_form.html">
                            <button type="button" class="btn btn-outline-success">Buy</button>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center shadow-lg">
                        <h3>Device-<?php echo $i + 2 ?></h3>
                        <img src="/<?php echo $arrayProducts[$i + 1]; ?>" width="100%" class="col-10"><br>
                        <p> Width: 1m <br> High: 2m <br> Weight 5kg <br></p>
                        <!-- <a href="#"><button>Buy</button></a> -->
                        <a href="#">
                            <button type="button" class="btn btn-outline-success">Buy</button>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center shadow-lg">
                        <h3>Device-<?php echo $i + 3 ?></h3>
                        <img src="/<?php echo $arrayProducts[$i + 2]; ?>" width="100%" class="col-10"><br>
                        <p> Width: 1m <br> High: 2m <br> Weight 5kg <br></p>
                        <a href="#">
                            <button type="button" class="btn btn-outline-success">Buy</button>
                        </a>
                    </div>
                </div>
                <?php
                $i += 3;
            }
            ?>
        </div>
    </div>
</div>


<!--<div class="album py-5 bg-light">-->
<!--    <div class="container">-->
<!---->
<!--        --><?php //foreach ($items as $item): ?>
<!---->
<!--        <div class="row">-->
<!--            <div class="col-md-4">-->
<!--                <div class="card mb-4 shadow-sm">-->
<!--                                <div class="main_image">-->
<!--                                    <img src="/--><?php //echo $item->notes; ?><!--">-->
<!--                                </div>-->
<!--                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"-->
<!--                         xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"-->
<!--                         focusable="false" role="img" aria-label="Placeholder: Thumbnail">-->
<!--                        <title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/>-->
<!--                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>-->
<!--                    </svg>-->
<!---->
<!---->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                        <div class="d-flex justify-content-between align-items-center">-->
<!--                            <div class="btn-group">-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
<!--                            </div>-->
<!--                            <small class="text-muted">9 mins</small>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <div class="card mb-4 shadow-sm">-->
<!--                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                        <div class="d-flex justify-content-between align-items-center">-->
<!--                            <div class="btn-group">-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
<!--                            </div>-->
<!--                            <small class="text-muted">9 mins</small>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <div class="card mb-4 shadow-sm">-->
<!--                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
<!--                        <div class="d-flex justify-content-between align-items-center">-->
<!--                            <div class="btn-group">-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
<!--                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
<!--                            </div>-->
<!--                            <small class="text-muted">9 mins</small>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!--</div>-->

<!--<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>-->




