<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <div class="createBtnClass">
            <?= Html::button('Вставить', ['class'=>'adminPasteBtn btn btn-success']) ?>
            <?= Html::submitButton('Сохранить', ['class' => 'adminCreateBtn btn btn-success']) ?>
        </div>
    </div>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoriesBredCrumbs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php ActiveForm::end(); ?>


    <?php
    // "Paste" button click handling
    $purchaseTypeJS = <<<JS

    $(".adminPasteBtn").on("click",function() {
        $.ajax({
            url: '/admin/products/paste',
            type: 'POST',
            success: function (copedString) {
                // JSON to object
                const parsedString = JSON.parse(copedString);
                
                // insert coped string to Form
                $('#products-id').val(parsedString['id']);
                $('#products-categories').val(parsedString['categories']);
                $('#products-categoriesbredcrumbs').val(parsedString['categoriesBredCrumbs']);
                $('#products-title').val(parsedString['title']);
                $('#products-address').val(parsedString['address']);
                $('#products-content').val(parsedString['content']);
                $('#products-description').val(parsedString['description']);
                $('#products-size').val(parsedString['size']);
                $('#products-number').val(parsedString['number']);
                $('#products-price').val(parsedString['price']);
            },
            error: function () {
                console.log ("Failed");
            }
        });
    })
JS;
    $this->registerJs($purchaseTypeJS);
    ?>

</div>
