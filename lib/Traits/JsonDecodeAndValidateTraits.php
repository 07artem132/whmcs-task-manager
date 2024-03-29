<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.04.2019
 * Time: 15:51
 */

namespace WHMCS\Module\Addon\TaskManager\Traits;

use WHMCS\Module\Addon\TaskManager\Exceptions\InvalidJsonException;

trait JsonDecodeAndValidateTraits {
	/**
	 * @param string $string
	 * @param bool $assoc
	 *
	 * @return mixed
	 * @throws InvalidJsonException
	 */
	protected static function jsonDecodeAndValidate( $string, $assoc = false ) {
		// decode the JSON data
		$result = json_decode( $string, $assoc );

		// switch and check possible JSON errors
		switch ( json_last_error() ) {
			case JSON_ERROR_NONE:
				$error = ''; // JSON is valid // No error has occurred
				break;
			case JSON_ERROR_DEPTH:
				$error = 'Достигнута максимальная глубина стека.';
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$error = "Неверный или не корректный JSON.";
				break;
			case JSON_ERROR_CTRL_CHAR:
				$error = "Ошибка управляющего символа, возможно неверная кодировка.";
				break;
			case JSON_ERROR_SYNTAX:
				$error = "Синтаксическая ошибка, не корректный JSON.";
				break;
			// PHP >= 5.3.3
			case JSON_ERROR_UTF8:
				$error = "Некорректные символы UTF-8, возможно неверная кодировка.";
				break;
			// PHP >= 5.5.0
			case JSON_ERROR_RECURSION:
				$error = "Одна или несколько зацикленных ссылок в кодируемом значении.";
				break;
			// PHP >= 5.5.0
			case JSON_ERROR_INF_OR_NAN:
				$error = "Одно или несколько значений NAN или INF в кодируемом значении.";
				break;
			case JSON_ERROR_UNSUPPORTED_TYPE:
				$error = "Передано значение с неподдерживаемым типом.";
				break;
			default:
				$error = "Неизвестная ошибка при парсинге JSON.";
				break;
		}

		if ( $error !== '' ) {
			throw new InvalidJsonException( $error );
		}

		// is OK
		return $result;
	}
}