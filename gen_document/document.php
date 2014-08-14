<?php 

// require_once ("application/libraries/Pdf.php");
// require_once ("application/librariesXml_lib.php");

abstract class Document{
	abstract protected function getData();
	//abstract protected function getTemplate();
	//abstract public function save($name,$path);
	protected $suplier_info =array();
	// abstract protected function setData();
		
	protected function prepareSupllierCompanyData($db_data){
            $order_info['supplier_logo'] = isset($db_data['company_logo'])?$db_data['company_logo']:"";
            $order_info['supplier_head_sign'] = isset($db_data['head_sign'])?$db_data['head_sign']:"";
            $order_info['accountant_sign'] = isset($db_data['accountant_sign'])?$db_data['accountant_sign']:"";
            $order_info['company_seal'] = isset($db_data['company_seal'])?$db_data['company_seal']:"";
            $order_info['head_position'] = !empty($db_data['head_position'])?$db_data['head_position']:"";
              	
            $order_info['date_invoice'] = date('d-m-Y');
            $order_info['supplier_full_name'] = $db_data['full_name'];
            $order_info['supplier_legal_address'] = $db_data['legadl_address'];
            $order_info['supplier_inn']  = !empty($db_data['INN'])?$db_data['INN']:"";
            $order_info['supplier_kpp']  = !empty($db_data['KPP'])?"/".$db_data['KPP']:"";
             //$glue = 
            $order_info['supplier_kpp_inn'] =  "ИНН/КПП:".$order_info['supplier_inn'].$order_info['supplier_kpp'];
       	
            $order_info['supplier_phone'] =isset($db_data['phone'])?$db_data['phone']:"";
            $order_info['supplier_bill'] = $db_data['payment_account'];
            $order_info['supplier_bank_and_address'] = $db_data['bank'];
            $order_info['supplier_bik'] =$db_data['BIK'];
            $order_info['supplier_korr_bill'] =$db_data['corr_account'];;
            $order_info['supplier_head'] =$db_data['head'];
            if(isset($db_data['accountant']) and !empty($db_data['accountant'])){
                $order_info['supplier_accountant'] =$db_data['accountant'];
            }
            else{
                $order_info['supplier_accountant'] =$db_data['head'];
            }

            return $order_info;
            }
	
	// function generatePdf($data,$path){
	

	// }
}