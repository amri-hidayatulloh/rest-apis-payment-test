<?php
class Helper {
	private $headers = [
		200 => "HTTP/1.0 200 OK",
		201 => "HTTP/1.0 201 Created",
		400 => "HTTP/1.0 400 Bad Request",
		404 => "HTTP/1.0 404 Not Found",
		409 => "HTTP/1.0 409 Conflict",
		500 => "HTTP/1.0 500 Internal Server Error"
	];

	//Clean GET parameter
	public function get($name) {
		if(!isset($_GET[$name])) {
			return "";
		}

		return filter_var($_GET[$name], FILTER_SANITIZE_STRING);
	}

	//Clean POST parameter
	public function post($name) {
		if(!isset($_POST[$name])) {
			return "";
		}

		return filter_var($_POST[$name], FILTER_SANITIZE_STRING);
	}

	//Response
	public function response($code, $message, $datas = []) {
		if(!isset($this->headers[$code])) {
			header($this->headers[500]);
		} else {
			header($this->headers[$code]);
		}
		
		$response = [
			'code' => $code,
			'message' => $message
		];

		if(count($datas)) {
			$response['data'] = $datas;
		}

		echo json_encode($response);
		die();
	}
}