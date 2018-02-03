<?php
include __DIR__.'/../config.php';
include Class_path.'class.store.php';

$response = new stdClass();

if(isset($_POST['createRequest']))
{
	$req = $_POST['createRequest'];
	$data = store::createRequest($req);
	$response->data = $data;
}
if(isset($_POST['updateMrn']))
{
	$mrn = $_POST['updateMrn'];
	$data = store::updateMrn($mrn);
	$response->data = $data;
}
if(isset($_POST['getInventory']))
{
	$data = store::getInventory();
	$response->data = $data;
}
if(isset($_POST['getOrderDetails']))
{
	$data = store::getOrderDetails($_POST['getOrderDetails']);
	$response->data = $data;
}
if(isset($_POST['getRequest']))
{
	$data = store::getRequest();
	$response->data = $data;
}
if(isset($_POST['acceptRequisition']))
{
	$request_id = $_POST['acceptRequisition'];
	$data = store::acceptRequisition($request_id);
	$response->data = $data;
}
if(isset($_POST['declineRequisition']))
{
	$request_id = $_POST['declineRequisition'];
	$reason = $_POST['reason'];
	$data = store::declineRequisition($request_id,$reason);
	$response->data = $data;
}
if(isset($_POST['getSupplierDetails']))
{
	$request_id = $_POST['getSupplierDetails'];
	if(!isset($_POST['supplier_id']))
		$data = store::getSupplierDetails();
	else
		$data = store::getSupplierDetails($_POST['supplier_id']);
	$response->data = $data;
}
if(isset($_POST['getProductType']))
{
	$type = $_POST['getProductType'];
	$data = store::getProductType($type);
	$response->data = $data;
}
if(isset($_POST['getProductSubType']))
{
	$type = $_POST['getProductSubType'];
	$data = store::getProductSubType($type);
	$response->data = $data;
}
if(isset($_POST['getProductName']))
{
	$type = $_POST['getProductName'];
	$data = store::getProductName($type);
	$response->data = $data;
}
if(isset($_POST['sendPo']))
{
	$type = $_POST['sendPo'];
	$data = store::sendPo($type);
	$response->data = $data;
}
echo json_encode($response);
