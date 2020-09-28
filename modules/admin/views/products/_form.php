<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasteBtnClass">
    <?= Html::button('Вставить', ['class'=>'adminPasteBtn btn btn-success']) ?>
</div>


<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'class'=>'adminCreateID']) ?>

    <?= $form->field($model, 'categories')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoriesBredCrumbs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <div class="createBtnClass">
            <?= Html::submitButton('Сохранить', ['class' => 'adminCreateBtn btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>



        <p class="deliveryTypeInTable">Тип доставки:</p>



    <?php
    // "Copy" button click handling
    $purchaseTypeJS = <<<JS

    $(".adminPasteBtn").on("click",function() {
        $.ajax({
            url: '/admin/products/paste',
            // data: {idCopedString: ""},
            type: 'POST',
            success: function (temp) {
            console.log(temp);
            
             // $('.adminCreateID').html(temp(id));
             $('.deliveryTypeInTable').html(temp(id));
            
            // alert(purchaseType);
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
