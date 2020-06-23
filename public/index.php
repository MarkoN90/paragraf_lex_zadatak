<?php
require '../vendor/autoload.php';

$session = new App\Session();

if($session->has('errors')) {
  $errors = $session->get('errors');
  $session->forget('errors');
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
  <?php message($session); ?>

  <nav class="container-fluid bg-primary">
    <div class="container">
      <ul class="navigation-list">
        <li><a href="index.php">Unos novog osiguranja</a> </li>
        <li><a href="pregled_polisa.php">Pregled polisa</a> </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <form id="polisaOsiguranja" action="kreiranje_polise.php" method="post">
      <h3 class="text-center p-3">Forma za unos novog osiguranja</h3>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="">Nosilac osiguranja (Ime i Prezime) *</label>
            <input class="form-control  required" type="text" name="ime_osiguranika" value="">
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="">Datum rodjenja *</label>
            <input class="form-control required" type="date" name="datum_rodjenja" value="">

          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="">Broj telefona</label>
            <input class="form-control" type="text" name="telefon" value="">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="">Broj pasosa *</label>
            <input class="form-control required" type="text" name="broj_pasosa" value="">

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="" >E-mail *</label>
            <input class="form-control required" type="email" name="email" value="">
          </div>
        </div>

      </div>

      <h5>Datum putovanja</h5>

      <div class="row">

        <div class="col-12  col-md-5">
          <div class="form-group">
            <label for="">Od:</label>
            <input class="form-control datum_putovanja" type="date" name="pocetak_putovanja" value="">
          </div>
        </div>

        <div class="col-12 col-md-5">
          <div class="form-group">
            <label for="">Do:</label>
            <input class="form-control datum_putovanja" type="date" name="kraj_putovanja" value="">
          </div>
        </div>

        <div class="col-12  col-md-2">
          <h6 class="text-center">Broj dana</h6>
          <h2 id="trajanjePuta" class="text-center">0</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <label for="">Tip Osiguranja</label>
          <div class="form-group">
            <select id="tipOsiguranja"class="form-control" name="tip_osiguranja">
              <option value="individualno">Individualno</option>
              <option value="grupno">Grupno</option>
            </select>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="">&nbsp;</label>
            <button id="dodajNovogOsiguranikaBtn" class="form-control btn btn-primary" type="button" name="button">Dodaj osiguranika + </button>
          </div>

        </div>

      </div>
      <div id="dodatniOsiguraniciDiv" class="m-2">
      </div>
      <div class="form-group">
        <span class="my-4 small d-block" > Polja oznacena sa * su obavezna</span>
        <button type="submit" class="btn btn-primary text-white" name="button">Sacuvaj</button>
      </div>
      <?php if(isset($errors)) { ?>
        <div class="card">
          <ul>
            <?php foreach ($errors as $error) { ?>
              <li><?php echo $error;  ?></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
    </form>
  </div>

</body>
<script src="js/script.js"></script>
</html>
