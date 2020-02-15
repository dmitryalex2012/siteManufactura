<body class="contact">

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
echo "<br>";

echo "<br>";

?>


<div class="weOnMap col-12 col-lg-9">
    <div id="map"></div>
</div>
<script>
    let map;
    let marker;
    let inscription = ['Bondi ', -33.890542, 151.274856, 4];
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 50.466282, lng: 30.615236},
            zoom: 15
        });
        marker = new google.maps.Marker({
            position: {lat: 50.466282, lng: 30.615236},
            map: map,
            // title: "Дизайн-бюро 'Мануфактура'",
            title: inscription,
            // label: "Мануфактура",
        });

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJhXz9qSSw8KjSOnjMW8b1qeD1AfRmU-4&callback=initMap"
        async defer>
</script>

<div class="ourContacts col-12 col-lg-3">
    <p class="contactsHeading">ЗВОНИТЕ:</p>
    <p class="contactsInformation">+38(097)927-25-84</p>
    <p class="contactsInformation">+38(066)034-39-57 (viber)</p>
    <br>
    <br>

    <p class="contactsHeading">ПИШИТЕ:</p>
    <p class="contactsInformation">snn.manufactura@gmail.com</p>
    <br>
    <br>

    <p class="contactsHeading">ПРИЕЗЖАЙТЕ:</p>
    <p class="contactsInformation">г. Киев, ул. Шалетт Города 1, оф. 208</p>
    <p class="contactsInformation">Мы работаем каждый день с 9 до 20</p>
    <p class="contactsInformation">Пожалуйста, перезвоните заранее</p>
    <br>
    <br>
</div>
