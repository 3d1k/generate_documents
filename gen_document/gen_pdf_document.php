<?php 
require_once('pdf/pdf_invoice.php');
require_once('pdf/pdf_shet_factura.php');
require_once('pdf/pdf_act.php');

class Gen_Pdf_Document{
	function generateInvoice($name,$path,$company_info,$order_info){
		
		$invoice = new Pdf_Invoice;
		$invoice->setData($company_info,$order_info);
		return $invoice->save($name,$path);
	}
	function generateShetFactura($name,$path,$company_info,$shet_info){
		
		$shet = new Pdf_Shet_Factura;
		$shet->setData($company_info,$shet_info);
		return $shet->save($name,$path);
	}
	function generateAct($name,$path,$company_info,$order_info){
		$act = new Pdf_Act;
		if($act->setData($company_info,$order_info))
			return $act->save($name,$path);
		return false;
	}
}