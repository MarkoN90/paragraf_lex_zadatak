<?php

require '../vendor/autoload.php';
$request = new App\Request;

if(!isset($request->id)) {
	 redirect_to('pregled_polisa.php');
}

$polisa = (new App\PolisaOsiguranja)->find_by_id($request->id);

if(!$polisa) {
	 error('Polisa nije pronadjena.');
}

if($polisa->tip_osiguranja != 'grupno') {
	 error('Polisa nije grupnog tipa.');
}

$osiguranici = $polisa->osiguranici();
 ?>


<!DOCTYPE html>
<html lang="sr-rs" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/master.css">
		<title></title>
	</head>
	<body>
			 <nav class="container-fluid bg-primary">
			 		<div class="container">
						<ul class="navigation-list">
							<li><a href="index.php">Unos novog osiguranja</a> </li>
							<li><a href="pregled_polisa.php">Pregled polisa</a> </li>
						</ul>
			 		</div>
			 </nav>
			<div class="container">
				<h3 class="text-center p-3">Dodatni osiguranici za polisu #<?php echo $polisa->id; ?></h3>

				<?php foreach ($osiguranici as $index => $osiguranik) { ?>

					<table class="table table-bordered">
						<h3 class="text-center"><?php echo $index + 1; ?></h3>
            <tr>
              <td>Ime i prezime osiguranika</td>
              <td>Broj pasosa</td>
              <td>Datum rodjenja</td>
            </tr>

						<tr>
							<td><?php echo $osiguranik->ime_osiguranika; ?></td>
							<td><?php echo $osiguranik->broj_pasosa; ?></td>
							<td><?php echo format_date($osiguranik->datum_rodjenja); ?></td>
						</tr>

					</table>
				<?php } ?>

					</table>

					<h5 class="text-center"><a href="polisa.php?id=<?php echo $polisa->id; ?>">< Nazad</a></h5>

			</div>
	</body>
 </html>
