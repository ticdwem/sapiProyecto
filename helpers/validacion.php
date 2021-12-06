<?php

/**
 * AUTHOR : MIGUEL ANGEL FERNANDEZ TRUJILLO;
 * DATE: 15/11/2018
 */
class Validacion
{


	/* public static function validarRFC($valor1){ */
	public static function validarRFC($valor)
	{
		$valor = str_replace("-", "", $valor);
		$cuartoValor = substr($valor, 3, 1);
		//RFC sin homoclave
		if (strlen($valor) == 10) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			if (ctype_alpha($letras) && ctype_digit($numeros)) {
				return true;
			}
			return false;
		}
		// Sólo la homoclave
		else if (strlen($valor) == 3) {
			$homoclave = $valor;
			if (ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		}
		//RFC Persona Moral.
		else if (ctype_digit($cuartoValor) && strlen($valor) == 12) {
			$letras = substr($valor, 0, 3);
			$numeros = substr($valor, 3, 6);
			$homoclave = substr($valor, 9, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
			//RFC Persona Física. 
		} else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			$homoclave = substr($valor, 10, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}



	public static function pregmatchletras($valor1)
	{

		$vacio = self::emptySpace($valor1);
		if ($vacio != 1 && preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ_.,\s\']+$/", $valor1)) {
			return mb_strtoupper($valor1, 'UTF-8');
		} else {
			return 0;
		}
	}
	public function pregmatchletrasAcento($valor1)
	{

		$vacio = self::emptySpace($valor1);
		if ($vacio != 1 && preg_match("/^[a-zA-ZñÑ\s\']+$/", $valor1)) {
			return mb_strtoupper($valor1, 'UTF-8');
		} else {
			return 0;
		}
	}

	public static function validarSelect($selectFrom)
	{
		if ($selectFrom == "") {
			return -1;
		} else {
			return $selectFrom;
		}
	}

	public static function validarLArgo($texto, $valorLArgo)
	{
		$largo = strlen($texto);
		if ($largo <= $valorLArgo) {
			return $texto;
		} else {
			return -1;
		}
	}

	public function camposReadOnly($valor)
	{
		if (!empty($valor)) {
			return $valor;
		} else {
			return "null";
		}
	}

	public static function emptySpace($space)
	{

		if (!preg_match("/^\s*$/", $space)) {
			return $space;
		} else {
			return 1;
		}
	}

	public static function valFecha($date)
	{
		$date;
		if ($date != "") {
			$fecha = explode("-", $date);

			if (preg_match("/^[0-9]{4}+$/", $fecha[0])) {
				$fecha1 = (self::validarNumero($fecha[1]) == '-1') ? false : $fecha[1];
				$fecha2 = (self::validarNumero($fecha[0]) == '-1') ? false : $fecha[0];
				$fecha3 = (self::validarNumero($fecha[2]) == '-1') ? false : $fecha[2];
				if (checkdate($fecha1, $fecha3, $fecha2)) {
					$checkday = self::addZeroDate($fecha[2]);
					$checkMonth = self::addZeroDate($fecha[1]);

					$newFecha = $fecha[0] . "-" . $checkMonth . "-" . $checkday;
					$date = $newFecha;
				} else {
					return 0;
				}
			} elseif (preg_match("/^[0-9]{2}+$/", $fecha[0])) {
				$fecha1 = (self::validarNumero($fecha[1]) == '-1') ? false : $fecha[1];
				$fecha2 = (self::validarNumero($fecha[0]) == '-1') ? false : $fecha[0];
				$fecha3 = (self::validarNumero($fecha[2]) == '-1') ? false : $fecha[2];
				if (checkdate($fecha1, $fecha2, $fecha3)) {
					$checkday = self::addZeroDate($fecha[0]);
					$checkMonth = self::addZeroDate($fecha[1]);

					$newFecha = $fecha[2] . "-" . $checkMonth . "-" . $checkday;
					$date = $newFecha;
				} else {
					return 0;
				}
			} elseif (preg_match("/^[0-9]{1}+$/", $fecha[0])) {
				$fecha1 = (self::validarNumero($fecha[1]) == '-1') ? false : $fecha[1];
				$fecha2 = (self::validarNumero($fecha[0]) == '-1') ? false : $fecha[0];
				$fecha3 = (self::validarNumero($fecha[2]) == '-1') ? false : $fecha[2];
				if (checkdate($fecha[1], $fecha[0], $fecha[2])) {
					$checkday = self::addZeroDate($fecha[0]);
					$checkMonth = self::addZeroDate($fecha[1]);

					$newFecha = $fecha[2] . "-" . $checkMonth . "-" . $checkday;
					$date = $newFecha;
				} else {
					return 0;
				}
			}
			return $date;
		} else {
			return -1;
		}
	}
	public static function addZeroDate($dayOrMonth)
	{
		$count = strlen($dayOrMonth);
		$correct = 0;
		if ($count == 1) {
			$correct = "0" . $dayOrMonth;
		} else {
			$correct = $dayOrMonth;
		}
		return $correct;
	}
	
	public static function validarTelefono($telefono)
	{
		$phoneNumber = "/^[0-9-()+]{3,20}/";

		if (preg_match('/^[0-9]{3,20}$/', $telefono) || $telefono == "00000000") {
			return $telefono;
		} else {
			return 0;
		}
	}

	public static function validarEmail($email)
	{
		if (!$email == "") {
			if (preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}[.][a-zA-Z]{2,4}$/", $email) || preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $email)) {
				return $email;
			} else {
				return 0;
			}
		} else {
			return 1;
		}
	}
	public static function validarPass($pass)
	{

		if (!$pass == "") {
			//  if(preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])\S{8,50}/', $pass)){
			if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $pass)) {

				return $pass;
			} else {
				return 0;
			}
		} else {
			return 1;
		}
	}

	public static function textoLargo($texto,$largo)
	{
		if ($texto != "") {
			$contar = strlen($texto);
			if (preg_match("/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_.+\s]+$/", $texto) && $contar <= $largo) {
				return strtoupper($texto);
			} else {
				return 900;
			}
		} else {
			return 0;
		}
	}

	public function numerico($numero)
	{
		if (!preg_match("/^\s*$/", $numero || $numero != "")) {
			return $numero;
		} else {
			return "S/N";
		}
	}

	public static function validarNumero($numeros)
	{
		if (is_numeric($numeros)) {
			return $numeros;
		} else {
			return -1;
		}
	}

	public static function validarFloat($num)
	{
		if (is_numeric($num)) {
			$numero = (float)$num;
		}else{
			$numero =false;
		}

		return $numero;
	}

	/* recortar texto funciona: texto= texto a recortar  $lengthTexto= cuantos datos vamos a tomar $maximosShow=pasamos los numero del texto que usaremos*/
	public static function recotarPuntos($texto, $lengthTexto, $maximosShow)
	{
		$puntos = "...";
		$contar = strlen($texto);
		if ($contar > $maximosShow) {
			$textoCortado = substr($texto, 0, $lengthTexto) . $puntos;
		} else {
			$textoCortado = $texto;
		}
		return $textoCortado;
	}

	public static function validarArray($array, $tipo)
	{
		$regreso = "";
		$largoDelTexto = "";
		$valor = "";
		switch ($tipo) {
			case 'string':
				$largoDelTexto = 50;
				$valor = 'textoLargo';
				break;
			case 'number':
				$largoDelTexto = 10;
				$valor = 'validarTelefono';
				break;
			case 'email':
				$largoDelTexto = "";
				$valor = 'validarEmail';
				break;
			case 'integer':
				$largoDelTexto = "";
				$valor = 'validarNumero';
				break;
			default:
				# code...
				break;
		}

		foreach ($array as $dato) {
			$val = self::$valor($dato, $largoDelTexto);
			if ($val == '900' || $val == '0') {
				$regreso = '800';
				break;
			} else {
				$regreso = '1';
			}
		}
		return $regreso;
	}
}
