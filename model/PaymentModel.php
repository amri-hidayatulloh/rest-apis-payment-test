<?php
class PaymentModel {
	private $conn;

	function __construct($connections = null) {
		$this->conn = $connections;
	}

	public function getPayment($invoice_id = null, $merchant_id = 0) {
		$stmt = $this->conn->prepare("SELECT * FROM payment WHERE merchant_id = ? AND invoice = ?");
		$stmt->execute([$merchant_id, $invoice_id]);
		$datas = $stmt->fetchAll();

		return end($datas);
	}

	public function getPaymentByInvoice($invoice_id = null) {
		$stmt = $this->conn->prepare("SELECT * FROM payment WHERE invoice = ?");
		$stmt->execute([$invoice_id]);
		$datas = $stmt->fetchAll();

		return end($datas);
	}

	public function createPayment($attr = []) {
		$attr['created_at'] = date('Y-m-d H:i:s');

		$sql = "INSERT INTO payment (invoice, merchant_id, item_name, amount, payment_type, customer_name, created_at) VALUES (:invoice, :merchant_id, :item_name, :amount, :payment_type, :customer_name, :created_at)";
		$stmt = $this->conn->prepare($sql);
		$insert = $stmt->execute($attr);

		if($insert) {
			$return = [
				'references_id' => (int) $this->conn->lastInsertId(),
				'payment_type' => $attr['payment_type'],
				'status' => 'pending'
			];

			if($attr['payment_type'] == 'virtual_account') {
				$return['number_va'] = $this->createVANumber();
			}

			$this->logChange([
				'payment_id' => $return['references_id'],
				'status' => $return['status'],
				'additional_info' => (isset($return['number_va'])) ? $return['number_va'] : ""
			]);

			return $return;
		}

		return false;
	}

	public function createVANumber() {
		return rand(111111111111111,999999999999999);
	}

	public function updatePaymentStatus($invoice_id = null, $status = 'pending') {
		$sql = "UPDATE payment SET status = ? WHERE invoice = ?";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute([$status, $invoice_id]);
	}

	public function logChange($attr = []) {
		$attr['created_at'] = date('Y-m-d H:i:s');

		$sql = "INSERT INTO payment_logs (payment_id, additional_info, status,  created_at) VALUES (:payment_id, :additional_info, :status,  :created_at)";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($attr);
	}
}