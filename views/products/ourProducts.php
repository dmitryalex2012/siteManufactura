<?php

/* @var $this yii\web\View */

//$this->title = 'Products list';
?>

<p>Content</p>
<?php foreach ($items as $key=>$item): ?>
<div>
    <img src="/<?php echo $item->address; ?>" width="200px">
    <p><?php echo $item->content; ?></p>
</div>
<?php endforeach;?>
