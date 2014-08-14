<?php 

require_once ("application/libraries/gen_document/Document_pdf.php");

class Pdf_Shet_Factura extends Document_Pdf{

	function __construct(){
            parent::__construct();
            $this->setTemplate('shet-factura');
	}
	function setData($company_info,$shet_info){
		$this->CI->load->helper('date');	
//                $this->CI->load->library('money');
		$shet = $this->prepareSupllierCompanyData($company_info);
		$shet['date_invoice'] = unix_to_human_rus($shet['date_invoice']);
		
		$products= json_decode($shet_info['description'],TRUE);
		$shet['total_sum'] = 0;
		$shet['total_sum_with_nds'] = 0;
		$shet['total_nds'] = 0;
                $shet['number_order'] = $shet_info['number'];
		if(is_array($products)){
			foreach ($products as $key => $product) {
				$total_for_product = (int)$product['cost']*(int)$product['quantity'];
				$total_nds_for_product = $total_for_product*0.18;
				$total_for_product_with_nds = $total_for_product+$total_nds_for_product;
				$shet['products'][] = array('product'=>$product['product'],
					                        'um'=>$product['um'],
					                        'quantity'=>$product['quantity'],
					                        'cost'=>$product['cost'],
					                        'total_without_nds'=>$total_for_product,
					                        'nds'=>0.18,
                                                                'nds_str'=>'18%',   
					                        'total_nds'=>$total_nds_for_product,
					                        'total_with_nds'=>$total_for_product_with_nds,
					                        'excise'=>'без акциза',
					                        'um_code'=>'796',
					                        'country'=>'--',
					                        'country_code'=>'--',
					                        'customs'=>'--');
				$shet['total_sum']+=$total_for_product;
				$shet['total_sum_with_nds'] += $total_for_product_with_nds;
				$shet['total_nds']+=$total_nds_for_product;
			}

		} 
		$shet['payer_company'] = $shet_info['company'];
      	$shet['payer_type'] =  $shet_info['type'];
      	$shet['payer_legal_address'] = $shet_info['legal_address'];
       	$shet['payer_inn']  = !empty($shet_info['INN'])?$shet_info['INN']:"";
       	$shet['payer_kpp']  = !empty($shet_info['KPP'])?"/".$shet_info['KPP']:"";
       	$shet['payer_inn_kpp']= $shet['payer_inn'].$shet['payer_kpp'];
		$shet['payer_consignee']=$shet['payer_company']." ".$shet['payer_legal_address'];
		$shet['currency']= "код Рубли, 643";
		$this->_gen_data = $shet;
	}
}