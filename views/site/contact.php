<body class="contact">

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
?>


<div class="weOnMap col-12 col-md-9">
    <div id="map"></div>
</div>
<script>
    let  setLatLng = {lat: 50.466282, lng: 30.615236};
    function initMap() {
        let map = new google.maps.Map(document.getElementById('map'), { // load map with zoom 15
            center: setLatLng,
            zoom: 15
        });
        let marker = new google.maps.Marker({                           // load marker
            position: setLatLng,
            map: map,
            title: 'Дизайн-бюро "Мануфактура"',
            label: {
                text: "М",
                fontWeight: 'bold',
                fontSize: '18px',
            },
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJhXz9qSSw8KjSOnjMW8b1qeD1AfRmU-4&callback=initMap"
        async defer>
</script>

<div class="ourContacts col-12 col-md-3">
    <p class="contactsHeading">ЗВОНИТЕ:</p>
    <p class="contactsInformation">+38(097)927-25-84</p>
    <p class="contactsInformation">+38(066)034-39-57 (viber)</p>
<!--    <br>-->
<!--    <br>-->

    <p class="contactsHeading">ПИШИТЕ:</p>
    <p class="contactsInformation">snn.manufactura@gmail.com</p>
<!--    <br>-->
<!--    <br>-->

    <p class="contactsHeading">ПРИЕЗЖАЙТЕ:</p>
    <p class="contactsInformation">г. Киев, ул. Шалетт Города 1, оф. 208</p>
    <p class="contactsInformation">Мы работаем каждый день с 9 до 20</p>
    <p class="contactsInformation">Пожалуйста, перезвоните заранее</p>
    <br>
    <br>
</div>
