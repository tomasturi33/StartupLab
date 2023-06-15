<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<style type="text/css">
			.button {
			  background-color: #f44336 ;
			  border: none;
			  border-radius: 8px;
			  box-shadow: rgba(0, 0, 0, .2) 0 2px 4px 0;
			  box-sizing: border-box;
			  color: white;
			  cursor: pointer;
			  font-family: "Akzidenz Grotesk BQ Medium", -apple-system, BlinkMacSystemFont, sans-serif;
			  font-size: 18px;
			  font-weight: 300;
			  outline: none;
			  outline: 0;
			  padding: 20px;
			  text-align: center;
			  text-transform: uppercase;
			  text-decoration: none;
			  transform: translateY(0);
			  transition: transform 150ms, box-shadow 150ms;
			  user-select: none;
			  -webkit-user-select: none;
			  touch-action: manipulation;
			}

			.button:hover {
			  box-shadow: rgba(0, 0, 0, .15) 0 3px 9px 0;
			  transform: translateY(-2px);
			}
			
			.title {
				font-size: 18px;
				font-weight: 300;
			}

			.text {
				font-size: 16px;
				font-weight: 300;
			}

			@media (min-width: 768px) {
			  .button {
			    padding: 10px 30px;
			  }
			}
		</style>

		<title>UNLPotencia</title>
	</head>
	<body>
		<h4 class="title">Hola, {{ $name }}</h4>
		
		<p class="text">Tu socio te ha invitado a que completes tu perfíl en la convocatoria de UNL Potencia. Desde el programa UNL Potencia estamos contentos de que estén participando de esta nueva edición. Para poder continuar con la postulación, por favor completá tu perfil.
		</p>

		<div align="center" style="padding-top: 3rem;height: 80px;">
			<a style="color: white;" href="{{ $url }}" target="_blank" class="button" >Completar mi perfil</a>
		</div>
	</body>
</html>