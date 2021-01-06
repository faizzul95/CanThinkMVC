<?php

// Reference : https://supunkavinda.blog/php/input-validation-with-php

// Example use
// Input::toolong('Firstname',$firstname,50);
// Input::tooshort('Password',$password,6);

// Input::check(['email', 'password'], $_POST);

// // validate an integer
// $number = Input::int($_POST['number']);
// // validate a string
// $name = Input::str($_POST['name']);
// // convert to boolean
// $bool = Input::bool($_POST['boolean']);
// // validate an email
// $email = Input::email($_POST['email']);
// // validate a URL
// $url = Input::url($_POST['url']);

class  Input {

	static $errors = true;

	static function check($arr, $on = false) {
		if ($on === false) {
			$on = $_REQUEST;
		}
		foreach ($arr as $value) {	
			if (empty($on[$value])) {
				self::throwError('Data is missing', 900);
			}
		}
	}

	static function int($val) {
		$val = filter_var($val, FILTER_VALIDATE_INT);
		if ($val === false) {
			self::throwError('Invalid Integer', 901);
		}
		return $val;
	}

	static function str($val) {
		if (!is_string($val)) {
			self::throwError('Invalid String', 902);
		}
		$val = trim(htmlspecialchars($val));
		return $val;
	}

	static function bool($val) {
		$val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
		return $val;
	}

	static function email($val) {
		$val = filter_var($val, FILTER_VALIDATE_EMAIL);
		if ($val === false) {
			self::throwError('Invalid Email', 903);
		}
		return $val;
	}

	static function url($val) {
		$val = filter_var($val, FILTER_VALIDATE_URL);
		if ($val === false) {
			self::throwError('Invalid URL', 904);
		}
		return $val;
	}

	static function tooshort($fieldname, $val, $minimum) {
		$length = strlen($val);
		if ($length < $minimum) {
			self::throwError('Input value too short !', 905);		
		}
	}

	static function toolong($fieldname, $val, $maximum) {
		$length = strlen($val);
		if ($length > $maximum) {
			self::throwError('Input too long !', 905);		
		}
	}

	static function badcontent($fieldname, $val) {
		if (!preg_match("/^[a-zA-Z0-9 '-]*$/",$val)) {
			self::throwError('bad content', 906);		
		}
	}

	static function throwError($error = 'Error In Processing', $errorCode = 0) {
		if (self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}


}