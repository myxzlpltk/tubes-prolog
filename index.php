<?php include "bootstrap.php" ?>

<!doctype html>
<html lang="id">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/jqueryui-selectable/jquery-ui.min.css">

    <title>Pick A Hero</title>

    <style>
        .hero-image{
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        #selectable .card { cursor: pointer; }
        #feedback { font-size: 1.4em; }
        #selectable .ui-selecting .card { background: #FECA40; }
        #selectable .ui-selected .card { background: #F39814; color: white; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h3 class="display-6">Pilih Musuh</h3>
            <p class="text-center">Maksimal 5 Hero</p>
        </div>
        <div class="row gx-2 mb-3" id="selectable">
            <?php foreach($app->heroes as $hero): ?>
                <div class="col-3 col-sm-2 col-lg-1">
                    <div class="card mb-2 ui-state-default">
                        <div class="ratio ratio-1x1 hero-image" style="background-image: url('images/<?= e(urlencode($hero->getImage())) ?>')"></div>
                        <span class="text-center small hero-name"><?= e($hero->getName()) ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <button type="button" class="btn btn-primary" id="submit">Pilih Hero Saya</button>
    </div>

    <script type="text/javascript" src="vendor/jquery/jquery-3.6.0.slim.min.js"></script>
    <script type="text/javascript" src="vendor/jqueryui-selectable/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
            $("#selectable").bind("mousedown", function(e) {e.metaKey = true;}).selectable({
                selecting: function(event, ui) {
                    if ($("#selectable .ui-selected, .ui-selecting").length > 5) {
                        $("#selectable .ui-selecting").removeClass("ui-selecting");
                    }
                }
            });

            $('#submit').click(function (){
                var heroes = $('#selectable .ui-selected .hero-name').map((i, e) => e.innerText).toArray();

                let params = new URLSearchParams();
                heroes.forEach(hero => params.append('heroes', hero));

                window.location.href = "/calculate?" + params.toString()
            })
        })
    </script>
</body>
</html>