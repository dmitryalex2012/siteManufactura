<body class="services">

<div class="mainDescription">
    <h3>Мы предлагаем полный комплекс услуг по благоустройству Ваших окон. </h3>
</div>

<?php $i = 0;
foreach ($items as $key => $item):
    if ((((++$i) % 4) == 1)): ?>
        <div class="row">
    <?php endif; ?>
            <div class="card-group col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <img src="/<?php echo $item->notes; ?>" class="card-img-top" alt="100%">
                    <div class="card-body">
<!--                                        <h5 class="card-title">Название карточки</h5>-->
                        <p class="card-text"><?php echo $item->content; ?></p>
                    </div>
                </div>
            </div>
    <?php if ((($i % 4) == 0)): ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
