<?php 
require_once ("application/libraries/gen_document/Document_pdf.php");
class Pdf_Act extends Document_Pdf{
    function __construct(){
        parent::__construct();
        $this->setTemplate('act');
        $this->CI->load->helper('date'); 
        $this->CI->load->library('money');
    }

    function setData($company_info,$order){

        $order_info = $this->prepareSupllierCompanyData($company_info);// данные компании
        $order_product = json_decode($order['description'],true);
        $order_info['date_invoice'] = unix_to_human_rus($order['date']);
        $order_info['payer_company'] = $order['company'];
        $order_info['payer_type'] =  $order['type'];
        $order_info['payer_legal_address'] = $order['legal_address'];
        $order_info['payer_INN'] = $order['INN']; 
        $order_info['payer_KPP'] = $order['KPP']; 
        $order_info['number_order'] = $order['number'];
        
        $inn_string = (isset($order_info['supplier_inn']) and !empty($order_info['supplier_inn']))?" ИНН:".$order_info['supplier_inn'].",":"";
        $kpp_string = (isset($order_info['supplier_kpp']) and !empty($order_info['supplier_kpp']))?" КПП:".$order_info['supplier_kpp'].",":"";
        $order_info['supplier_full_fio'] = "{$order_info['supplier_full_name']},  $inn_string $kpp_string {$order_info['supplier_legal_address']}";
        //$order_info['description'] = "Покупка товаров "; //  через array_map соеденить названия продуктов наверно 
        $i=1;
        $total_sum = 0;
        
        if(is_array($order_product)){
            foreach ($order_product as $key => $value) {
                $sum =$value['total_sum']; //(int)$value['cost'] * (int)$value['quantity'];
                $total_sum +=$sum;
                $order_info['products'][] =array('number'=>$i,
                                                 'product'=>$value['product'],
                                                 'um'=>$value['um'],
                                                 'cost'=>$value['cost'],
                                                 'quantity'=>$value['quantity'],
                                                 'total_sum'=>$sum);
                $i++;
            }
        }

        $inn_string = (isset($order_info['payer_INN']) and !empty($order_info['payer_INN']))?" ИНН:".$order_info['payer_INN'].",":"";
        $kpp_string = (isset($order_info['payer_KPP']) and !empty($order_info['payer_KPP']))?" КПП:".$order_info['payer_KPP'].",":"";
        $order_info['payer_full_fio'] = " {$order_info['payer_company']}, $inn_string $kpp_string ".$order_info['payer_legal_address'];
        $order_info['total_sum'] = $total_sum;
        $order_info['payer_head'] = $order['head'];
        $order_info['payer_head_position'] = $order['head_position'];
        $order_info['nds'] = "18%";
        $order_info['summ_nds']=0.18*$total_sum;
        $order_info['total_sum_nds']=(float)$order_info['total_sum'] + (float)$order_info['summ_nds'];
        $order_info['money_stringify'] =$this->CI->money->exec($order_info['total_sum_nds']);
        $order_info['currency'] ="RUB";
        $this->_gen_data  = $order_info;
       
        return $this;
    }
}