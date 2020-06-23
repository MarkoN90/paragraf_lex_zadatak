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
				<h3 class="text-center p-3">Polisa osiguranja</h3>

					<table class="table table-bordered">
            <tr>
              <td> Dodatni osiguranici za </td>
              <td> <?php echo date_format(date_create($polisa->datum_unosa),"d.m.Y"); ?></td>
            </tr>
                <tr>
                  <td> Ime i prezime </td>
                  <td> <?php echo $polisa->ime_osiguranika; ?></td>

                </tr>


                  <tr>
                    <td> Datum rodjenja</td>
                    <td> <?php echo format_date($polisa->datum_rodjenja); ?></td>
                  </tr>

                  <tr>
                    <td> Broj pasosa</td>
                    <td> <?php  echo $polisa->broj_pasosa ; ?></td>
                  </tr>

                  <tr>
                    <td> Telefon</td>
                    <td> <?php  echo $polisa->telefon ; ?></td>
                  </tr>

                  <tr>
                    <td> E-mail</td>
                    <td> <?php  echo  $polisa->email ; ?></td>
                  </tr>

                  <tr>
                    <td> Pocetak putovanja</td>
                    <td> <?php echo format_date($polisa->pocetak_putovanja); ?></td>
                  </tr>

                  <tr>
                    <td> Kraj putovanja</td>
                    <td> <?php echo format_date($polisa->kraj_putovanja); ?></td>
                  </tr>
                  <tr>
                    <td> Broj dana</td>
                    <td> <?php  echo $polisa->trajanje_putovanja(); ?></td>
                  </tr>
                  <tr>
                    <td> Tip osiguranja</td>
                    <td>
                       <?php echo  $polisa->tip_osiguranja; ?>

                       <?php if($polisa->tip_osiguranja == 'grupno') { ?>
                          |  <a class="text-decoration-none" href="osiguranici.php?id=<?php echo $polisa->id ; ?>">&nbsp;Prikazi osiguranike</a>
                       <?php }  ?>
                    </a> </td>
                  </tr>



					</table>
          <h5 class="text-center"><a href="pregled_polisa.php">< Nazad</a></h5>

			</div>
	</body>
 </html>
