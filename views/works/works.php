<body class="works">

<?php
/* @var $temp string */
/* @var $worksList array */
?>

<!--    $worksList {                                                                                        -->
<!--        [title] =>   "Гостиная"                                                 (photo address)         -->
<!--        [content] => "Важнейшую роль в интерьере играют шторы, поэтому"         (our work description)  -->
<!--        [notes] =>   "foto/ourworks/livingRoom1.jpg,foto/ourworks/living....."  (photos address)        -->
<!--              }                                                                                         -->

<h1 class="h1InWorks">Наши работы</h1>

<div class="products">
    <?php foreach ($worksList as $key => $item): ?>
        <div class="row">
            <div class="col-12 col-lg-5">                            <!-- output "carousel" photos in this column -->
                <h3><?php echo $item->title; ?></h3>                 <!-- output title photos group -->

                <?php                                                  // make array with photo addresses and count photo quantity
                $photoAddress = (explode(",",$item->notes));  // $worksList[notes] contains relative path to
                $quantity = count(explode(",",$item->notes)); //   some photo of our work. Relative paths is
                ?>                                                    <!--  divided by "," each from other -->

                <div id="carouselExampleInterval<?php echo $item->id; ?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < $quantity; $i++): ?>
                            <li data-target="#carouselExampleIndicators1<?php echo $item->id; ?>"
                                data-slide-to="<?php echo $i; ?>" <?php if ($i === 0) { ?> class="active" <?php } ?>>
                            </li>
                        <?php endfor; ?>
                    </ol>

                    <div class="carousel-inner">
                        <?php for ($i = 0; $i < $quantity; $i++): ?>
                            <div class="carousel-item <?php if ($i === 0) { ?> active <?php } ?>"
                                 data-interval="1000000">
                                <img src="/<?php echo $photoAddress[$i]; ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endfor; ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleInterval<?php echo $item->id; ?>"
                       role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval<?php echo $item->id; ?>"
                       role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>

            <div class="col-12 col-lg-7">       <!-- output the photos description in this column -->
                <div class="worksDescription">
                    <?php $temp = $item->content;           // $worksList[content] contains the description of the "carousel" photos.
                    while (strpos($temp, '*') > 0) : // "*" is used instead of paragraph in description text.
                        ?>
                        <p><?php
                            echo stristr($temp, '*', true);
                            $temp = stristr($temp, '*');
                            $temp = substr($temp, 1);
                            ?>
                        </p>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>

