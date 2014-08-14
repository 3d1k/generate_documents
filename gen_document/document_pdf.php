<?php 

require_once ("Document.php");
require_once ("application/libraries/Pdf.php");
class Document_Pdf extends Document{
	private $_pdf;
	protected $_pdf_template;
	protected $_gen_data;
	protected $CI;
	function __construct(){
            $this->CI = &get_instance();
	}
	function save($name,$path,$type_output=""){
		$pdf =  $this->getPdfInstance()->loadTemplate($this->getTemplate(),$this->getData())->generatePdf($type_output,$name,$path);
       	if(is_file($pdf)){
       		return $pdf;
       	}
       	else return FALSE;
	}

	private function getPdfInstance(){
		if(is_null($this->_pdf))
		 	return $this->_pdf= new Pdf;
		return $this->_pdf;
	}
	protected function getTemplate(){
		return $this->_pdf_template;
	}

	function setTemplate($template){
		$this->_pdf_template = $template;
		return $this;
	}
	function generate($company_data,$data,$name,$path)
	{
	      return $this->setData($company_data,$data)->save($name,$path);
	}
	function getData(){
		return $this->_gen_data;
	}
	function setData($company_info,$data){
		// $set_data = 
		$this->_gen_data = array_merge($this->prepareSupllierCompanyData($company_info),$data);
		return $this;
	}
}