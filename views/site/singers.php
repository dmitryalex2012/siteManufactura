<?php /* @var $singers array */ ?>


<h1>DB output</h1>


<?php //use app\models\Singer; ?>


<ul>
    <?php foreach ($singers as $singer) { ?>
        <li><?=$singer->title?> : <?=$singer->description?></li>
    <?php } ?>
</ul>


