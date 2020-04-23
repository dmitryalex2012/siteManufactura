<body class="services">

<?php
/* @var $services array */
?>

<div class="mainDescription">
    <h3>Мы предлагаем полный комплекс услуг по благоустройству Ваших окон. </h3>
</div>

<!--    $services {                                                                    -->
<!--        [notes] =>   "foto/servicesDesignerСall.jpg"       (photo address)         -->
<!--        [content] => "Выезд дизайнера с образцами тканей"  (service description)   -->
<!--              }                                                                    -->
<?php $i = 0;
foreach ($services as $key => $item):
    if ((((++$i) % 4) == 1)): ?>                        <!--  output 4 cards in line -->
        <div class="row">
    <?php endif; ?>
    <div class="card-group col-12 col-lg-6 col-xl-3">
        <div class="card">
            <img src="/<?php echo $item->notes; ?>" class="card-img-top" alt="100%">
            <div class="card-body">
                <p class="card-text"><?php echo $item->content; ?></p>
            </div>
        </div>
    </div>
    <?php if ((($i % 4) == 0)): ?>                     <!-- close "div" after fourth card -->
    </div>
<?php endif; ?>
<?php endforeach; ?>
