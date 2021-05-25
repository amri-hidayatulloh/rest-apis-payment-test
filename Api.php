<?php
require "Autoload.php";

//Return header JSON
header('Content-Type: application/json');

if($helper->get('endpoint') != "") {

	if($helper->get('endpoint') == 'create') {

		/*
		* API Endpoint Create 
		*/

		$datas = [
			'invoice' => $helper->post('invoice_id'),
			'item_name' => $helper->post('item_name'),
			'amount' => $helper->post('amount'),
			'payment_type' => $helper->post('payment_type'),
			'customer_name' => $helper->post('customer_name'),
			'merchant_id' => $helper->post('merchant_id')
		];

		//Validate empty input
		$emptylists = [];

		foreach ($datas as $key => $value) {
			if(empty($value)) {
				$emptylists[] = $key;
			}
		}

		if(count($emptylists)) {
			$helper->response(400, 'Missing input parameter', $emptylists);
		}

		//Validate payment method
		if(!in_array($datas['payment_type'], ['credit_card','virtual_account'])) {
			$helper->response(400, 'Payment method unknown');
		}

		//Validate amount integer
		if(!is_numeric($datas['amount'])) {
			$helper->response(400, 'Amount should be number');
		}

		//Check existing
		$existing = $payment->getPayment($datas['invoice'], $datas['merchant_id']);

		if(count($existing)) {
			$helper->response(409, 'Payment is already exist');
		}

		//Created payment
		$trans = $payment->createPayment($datas);

		if($trans) {
			//fallback failed create payment
			$helper->response(200, 'Success', $trans);
		}

		//fallback failed create payment
		$helper->response(500,'Fail to create payment, try again later');

	} else if($helper->get('endpoint') == 'status') {

		/*
		* API Endpoint Get Status 
		*/

		$merchantId = $helper->get('merchantid');
		$invoice = $helper->get('invoice');

		if(empty($merchantId) or empty($invoice)) {
			$helper->response(400, 'Missing input parameter');
		}

		$payment = $payment->getPayment($invoice, $merchantId);

		if(count($payment)) {
			//If unknown method/endpoint
			$helper->response(200,'Success', [
				'references_id' => (int) $payment['id_payment'],
				'invoice_id' => $payment['invoice'],
				'status' => $payment['status']
			]);
		}

		//If unknown method/endpoint
		$helper->response(200,'Payment not found');
	
	} else {

		/*
		* API Endpoint Fallback
		*/
	
		//If unknown method/endpoint
		$helper->response(404,'Unknown endpoint');
	
	}

} else {

	//if endpoint parameter is missing
	$helper->response(404,'Unknown endpoint');

}


