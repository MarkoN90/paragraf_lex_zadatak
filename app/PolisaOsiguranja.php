<?php

namespace App;

use \App\Database\QueryBuilder;
use Request;
use \App\Osiguranik;
use \App\Mailer;

class PolisaOsiguranja extends QueryBuilder {


	static $table_name = 'polise_osiguranja';

	public function kreiraj_polisu($request) {


		$request->validate([
			'ime_osiguranika' => 'required',
			'datum_rodjenja' => 'required',
			'broj_pasosa' => 'required',
			'email' => 'required'
		]);

		$result = $this->create([
			'ime_osiguranika' => $request->ime_osiguranika,
			'datum_rodjenja' => $request->datum_rodjenja,
			'broj_pasosa' => $request->broj_pasosa,
			'telefon' => $request->telefon,
			'email' => $request->email,
			'pocetak_putovanja' => $request->pocetak_putovanja,
			'kraj_putovanja' => $request->kraj_putovanja,
			'tip_osiguranja' => $request->tip_osiguranja
		]);

		if($result) {

			$polisa_id = $this->pdo->lastInsertId();

			if(isset($request->ime_dodatnog_osiguranika)) {
				for($i = 0; $i < count($request->ime_dodatnog_osiguranika); $i++) {
					(new Osiguranik)->create([
						'polisa_osiguranja_id' => $polisa_id,
						'ime_osiguranika' => $request->ime_dodatnog_osiguranika[$i],
						'broj_pasosa' => $request->broj_pasosa_osiguranika[$i],
						'datum_rodjenja' => $request->datum_rodjenja_osiguranika[$i]
					]);
				}
			}

			$polisa = $this->find_by_id($polisa_id);
			$pdf = $this->kreiraj_pdf($polisa);
			(new Mailer )->send($polisa->email, 'Polisa Osiguranja', 'Postovani, saljemo Vam vasu polisu', $pdf);
		}

	}


	private function kreiraj_pdf($polisa) {
		$mpdf = new \Mpdf\Mpdf();

		$output = "
			<h2> Polisa osiguranja </h3><br></br>
			<h3>Ime i prezime: {$polisa->ime_osiguranika}</h3>
 			<h5>Datum unosa: {$polisa->datum_unosa}</h5>
			<h5>Datum rodjenja: {$polisa->datum_rodjenja}</h5>
			<h5>Broj pasosa: {$polisa->broj_pasosa}</h5>
			<h5>Telefon: {$polisa->telefon}</h5>
			<h5>E-mail: {$polisa->email}</h5>
			<h5>Pocetak putovanja: {$polisa->pocetak_putovanja}</h5>
			<h5>Kraj putovanja: {$polisa->kraj_putovanja}</h5>
			<h5>Tip osiguranja: {$polisa->tip_osiguranja}</h5>
			<h5>Broj dana: {$polisa->trajanje_putovanja()}</h5>
  ";
		$mpdf->WriteHTML($output);
		$filePath = '../documents/polisa_' . $polisa->id . '.pdf';
		$mpdf->Output($filePath, 'F');

		return $filePath;
	}

	public function trajanje_putovanja() {

		$interval = date_diff(date_create($this->pocetak_putovanja), date_create($this->kraj_putovanja));
		return $interval->format('%d');
	}

	public function osiguranici() {
		return (new Osiguranik)->findByValue('polisa_osiguranja_id', $this->id);
	}

	public function sortiraj_polise($request) {
		return $this->findAndSort($request->sortiraj_prema, $request->pravac_sortiranja);
		if(in_array($request->sortiraj_prema, ['sortiraj_prema', 'ime_osiguranika']) && in_array($request->pravac_sortiranja, ['asc', 'desc'])) {
		} else {
			redirect_to('pregled_polisa.php');
		}
	}
}





?>
