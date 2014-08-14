<?php 
require_once('gen_document/gen_pdf_document.php');
class Gen_Document {
	public $pdf;
	public $xml;
	function __construct(){
		$this->pdf = new Gen_Pdf_Document;
	}
	
}