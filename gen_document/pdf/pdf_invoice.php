<?php 

require_once ("application/libraries/gen_document/Document_pdf.php");

class Pdf_Invoice extends Document_Pdf{
    function __construct(){
        parent::__construct();
        $this->setTemplate('invoice_2');
    }
    function setData($company_data,$order){
        $this->CI->load->helper('date'); 
        $this->CI->load->library('money');
        
        $order_info = $this->prepareSupllierCompanyData($company_data);// данные компании
        
        $order_product = json_decode($order['description'],true);
        
        $order_info['date'] = unix_to_human_rus($order['date']);
        $order_info['payer_company'] = $order['company'];
        $order_info['payer_type'] =  $order['type'];
        $order_info['payer_legal_address'] = $order['legal_address'];
        $order_info['payer_INN'] = $order['INN']; 
        $order_info['payer_KPP'] = $order['KPP']; 
        $order_info['number_order'] = $order['number'];
        
        $i=1;
        $total_sum = 0;
        $is_order_array = false;
        if(is_array($order_product)){
            $is_order_array = true;
        }
        else{
            $order_product= json_decode(str_replace("'",'"', $order['description']),true);
            if(is_array($order_product)) $is_order_array = true;
        }       
        if($is_order_array){
            foreach ($order_product as $key => $value) {
                $sum =$value['total_sum']; //(int)$value['cost'] * (int)$value['quantity'];
                $total_sum+=$sum;
                $order_info['products']['product'][] =array('number'=>$i,'product'=>$value['product'],'um'=>'шт.','cost'=>$value['cost'],'quantity'=>$value['quantity'],'total_sum'=>$sum);
                $i++;
            }
        }
        $inn_string = (isset($order_info['payer_INN']) and !empty($order_info['payer_INN']))?$order_info['payer_INN']:"";
        $kpp_string = (isset($order_info['payer_KPP']) and !empty($order_info['payer_KPP']))?"/".$order_info['payer_KPP']:"";
        $order_info['fio'] = " {$order_info['payer_company']}, ИНН/КПП: $inn_string.$kpp_string, ".$order_info['payer_legal_address'];
        $order_info['total_sum'] = $total_sum;
        $order_info['money_stringify'] =$this->CI->money->exec($total_sum);
        $order_info['currency'] ="RUB";

        $this->_gen_data  = $order_info;
        return $this;
        //$data['funct'] = function($number){ return $this->money->exec($number);};


    }
	 
}