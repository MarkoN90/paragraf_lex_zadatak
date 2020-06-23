<?php
 require '../vendor/autoload.php';

 $request = new App\Request;

 if(isset($request->sortiraj_prema) && isset($request->pravac_sortiranja)) {
   $poliseOsiguranja = (new App\PolisaOsiguranja)->sortiraj_polise($request);
 } else {
   $poliseOsiguranja = (new App\PolisaOsiguranja)->all();
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
				<h3 class="text-center p-3">Polise osiguranja</h3>
       <form id="sortiranje_tabele" class="my-2" action="pregled_polisa.php" method="get">
         <div class="row">

           <div class="col-12 col-6">

           </div>
           <div class="col-12 col-6">

             <label for="">Sortirajte po</label>
              <select class="form control" name="sortiraj_prema">
                <option value="datum_unosa" <?php if(isset($request->sortiraj_prema) && $request->sortiraj_prema == 'datum_unosa') { echo " selected" ;} ?> >Datumu unosa</option>
                <option value="ime_osiguranika" <?php if(isset($request->sortiraj_prema) && $request->sortiraj_prema == 'ime_osiguranika') { echo " selected" ;} ?>>Imenu nosioca</option>

              </select>
              <select class="form control" name="pravac_sortiranja">
                <option value="desc" <?php if(isset($request->pravac_sortiranja) && $request->pravac_sortiranja == 'desc') { echo " selected" ;} ?>>Opadajuce</option>
                <option value="asc" <?php if(isset($request->pravac_sortiranja) && $request->pravac_sortiranja == 'asc') { echo " selected" ;} ?>>Rastuce</option>

              </select>
           </div>

         </div>
       </form>
					<table class="table table-bordered">
            <tr>
              <td>Datum kreiranja</td>
              <td>Ime i prezime nosioca</td>
              <td></td>

            </tr>
							<?php foreach ($poliseOsiguranja as $polisa) { ?>

								<tr>
									<td> <?php echo format_date($polisa->datum_unosa); ?></td>
									<td> <?php echo $polisa->ime_osiguranika; ?></td>
									<td> <a href="polisa.php?id=<?php echo $polisa->id; ?>">Prikazi</a></td>

								</tr>
							<?php } ?>
					</table>
			</div>
	</body>
	<script>

    let formaZaSortiranje = document.getElementById('sortiranje_tabele');
    formaZaSortiranje.addEventListener('change', (e) => {
      formaZaSortiranje.submit();
    });

  </script>
</html>
