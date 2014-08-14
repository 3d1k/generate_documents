<?php 

require_once ("Xml_lib.php");
class Document_Xml extends Document{
	private $_xml_lib = null;
	protected $CI;
	function __construct(){
		//$this->getXmlInstance();
		$this->CI = &get_instance();
		$this->CI->load->helper('date');	
      	$This->CI->load->library('money');
	}
	protected function saveAsXml($name,$path,$root_name="root"){ // TODO:проверка  на расширение файла
	
	    $xml =$this->getXmlInstance()->Array2Xml($root_name,$this->getData());
	   // $path= //'include/attachments/files/invoice_'.$id_order."_".date('d-m-Y').".xml";
	   
	   	$save_path =$path.$name.".xml"; 
	    $xml->save($save_path);
	    if(is_file($save_path)){
	   		return $save_path;
	   	}
	   	else return FALSE;
        
	}
	protected function saveAsXmlString($root_name="root"){
		
		$xml =$this->getXmlInstance()->Array2Xml($root_name,$this->getData());
        //$path= 'include/attachments/files/invoice_'.$id_order."_".date('d-m-Y').".xml";
        $xml_str =  $xml->saveXML();
        return $xml_str;
	}

	private function getXmlInstance(){
		if(is_null($this->_xml_lib))
		 	return $this->_xml_lib= new Xml_lib;
		return $this->_xml_lib;
		
	}
}