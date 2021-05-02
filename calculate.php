<?php

include "bootstrap.php";

$enemies = isset($_GET['enemies']) ? $_GET['enemies'] : [];

if(!$app->validateInput($enemies)){
    echo "Input tidak valid";
    http_response_code(403);
    exit();
}

// TODO calculate using prolog
$args = implode(" ", array_map(fn($x) => "\"{$x}\"", $enemies));
$out = array();
exec("swipl main.pl {$args}", $out);
$result = array();
foreach($out as $line){
	$x = explode(';', $line);
	$result[$x[0]] = floatval($x[1]);
}
$heroes = array_keys($result);
$myHeroes = array_filter((array)$app->heroes, function (Hero $hero) use ($heroes){
    return in_array($hero->getName(), $heroes);
});

$temp = $result;
ksort($temp);
array_multisort(array_values($temp), SORT_DESC, $myHeroes);
array_splice($myHeroes, 5);

$maxStats = $app->maxStats();

?>
<!doctype html>
<html lang="id">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">

    <title>Hasil Perhitungan</title>
</head>
<body>
    <div class="container py-5">
		<h1 class="display-6 text-center mb-5">Hasil Perhitungan</h1>

		<div class="row gx-3">
            <?php foreach($myHeroes as $hero): ?>
				<div class="col-md-6">
					<div class="card mb-3">
						<div class="row g-0">
							<div class="col-md-4 hero-image rounded-start" style="background-image: url('images/<?= e(urlencode($hero->getImage())) ?>')"></div>
							<div class="col-md-8">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-start mb-2">
										<div>
											<h5 class="card-title mb-0"><?= e($hero->getName()) ?><br></h5>
											<span class="small text-muted"><?= e($hero->getRole()) ?></span>
										</div>
										<span class="badge bg-success">Confidence <?= e(round($result[$hero->getName()], 2)) ?>%</span>
									</div>
									<div class="row gx-1">
                                        <?php foreach($hero->getStats() as $key => $value): ?>
											<div class="col-6">
												<small style="font-size: 0.75em"><?= e($key) ?></small>
												<div class="progress" style="height: 0.25rem;">
													<div class="progress-bar" role="progressbar" style="width: <?= $value/max($maxStats[$key], 1)*100 ?>%;"></div>
												</div>
											</div>
                                        <?php endforeach ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            <?php endforeach ?>
		</div>
    </div>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
