
			let forma = document.getElementById('polisaOsiguranja');

				let dodajNovogOsiguranikaBtn = document.getElementById('dodajNovogOsiguranikaBtn');
				let dodatniOsiguraniciDiv = document.getElementById('dodatniOsiguraniciDiv');
				let tipOsiguranja = document.getElementById('tipOsiguranja');
				let datum_putovanja = document.getElementsByClassName('datum_putovanja');
				let trajanjePuta = document.getElementById('trajanjePuta');

				// promena datuma putovanja

				for (let i = 0; i < datum_putovanja.length; i++) {
					datum_putovanja[i].addEventListener('change', (e) => {

						let dt1 = new Date(datum_putovanja[0].value);
						let dt2 = new Date(datum_putovanja[1].value);

            let diffDays =  (dt2 - dt1) / (1000 * 60 * 60 * 24) ;
						if(!isNaN(diffDays) && diffDays > 0) {
							trajanjePuta.innerText = diffDays;
						} else {
							trajanjePuta.innerText = 0;
						}
					})
				}

				// dodavanje dodatnog osiguranika
				dodajNovogOsiguranikaBtn.addEventListener('click', (e) => {
					let formGroup = document.createElement('div');

					formGroup.setAttribute('class', 'row');
					let input = `
					<div class="col-4">
					<label> Ime i prezime osiguranika </label>
					  <input class="form-control required" type="text" name="ime_dodatnog_osiguranika[]">
					</div>
						<div class="col-4">
					<label> Broj pasosa </label>
				  	<input class="form-control required" type="text" name="broj_pasosa_osiguranika[]">
					</div>

					<div class="col-3">
					<label> Datum rodjenja </label>
					<input class="form-control required" type="date" name="datum_rodjenja_osiguranika[]">
					</div>

					<div class="col-1 d-flex justify-content-end align-items-center">
					 <button class="btn-danger text white mt-4 cancel text-center" onclick="this.parentElement.parentElement.remove()">  &times; </button>
					</div>
					`;

		    	formGroup.innerHTML = input;
			  	dodatniOsiguraniciDiv.appendChild(formGroup);
				});

				// promena tipa osiguranja

				tipOsiguranja.addEventListener('change', (e) => {
					if(e.target.value == 'individualno') {
						 dodatniOsiguraniciDiv.innerHTML = '';
						 dodajNovogOsiguranikaBtn.style.display = 'none';
					} else {
						 dodajNovogOsiguranikaBtn.style.display = 'block';
					}
				});
				// validacija

				let requiredFields = document.getElementsByClassName('required');

				for (var i = 0; i < requiredFields.length; i++) {
					requiredFields[i].addEventListener('change', (e) => {
						let field = e.target;
						if(field.classList.contains('error') && field.value != '') {
							field.classList.remove('error');
						}
				});
 			}
				forma.addEventListener('submit', (e) => {
					e.preventDefault();

					let fieldWithErrors = [];
					for (let i = 0; i < requiredFields.length; i++) {
						if(requiredFields[i].value == '') {
							requiredFields[i].classList.add('error');
							fieldWithErrors.push(requiredFields[i]);
						}
					}

					if(fieldWithErrors.length == 0) {
						forma.submit();
					}
				});
