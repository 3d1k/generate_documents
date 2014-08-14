<?php 

require ("Document_xml.php");

class Xml_Xnvoice extends Document_Xml{

	private $_gen_data = array();
	// private $_pdf_template = '';
	/**
	 * Записывает данные Компании плательщика и данные заказа и данные компании плательщика в gen_data  
	 * @param Array $company_data данные компании поставщика
	 * @param Array $order        данные компании плтаельшика и данные заказа
	 */
	
	function setData($company_data,$orders){
		  $this->CI->load->helper('date');	
      $this->CI->load->library('money');
		  $order_info = array();
      $order_info = $this->prepareSupllierCompanyData($company_data);// данные компании
      //дата создание счета
      $payer_data =array();
      $order_info['payer_companies'] =array();
      foreach ($orders as $key => $order) {
          $payer_data[$order['cid']] = array('id'=>$order['cid'],
                          									 'company' => $order['company'],
                          									 'type'=> $order['type'],
                          									 'legal_address'=> $order['legal_address'],
                          									 'INN'=>$order['INN'],
                          									 'KPP'=>$order['KPP']);
      }
      $i = 0;
      foreach ($payer_data as $key => $value) {
          $order =array();
      	  foreach ($orders as $k => $v) {
      		    if($v['cid']==$key){
                  $order_product = json_decode(str_replace("'",'"', $v['description']),true);
                  if(is_array($order_product) and !empty($order_product)){
                      $total_sum = 0;
              			  $order[$i] =array('number_order'=>$v['number'],'description'=>'Описание заказа','id'=>$v['id'],'date'=>$v['date']); 
            			    $order[$i]['products']= array();
      		            $product_array  =array();
      			          foreach ($order_product as $key_product=> $product) {
      				        	  $sum = (int)$product['cost'] * (int)$product['quantity'];
      				        	  $total_sum+=$sum;
      				        	  $product_array[]=array('number'=>$product['id'],'product'=>$product['product'],'um'=>'шт.','cost'=>$product['cost'],'quantity'=>$product['quantity'],'total_sum'=>$sum);
                      }
      			        	$order[$i]['products'][]['product'] = $product_array;
                      $order[$i]['total_sum'] = $total_sum;
                      // $payer_data[$key]['orders'][$i]['order']['money_stringify'] = $CI->money->exec($total_sum);;
                      $order[$i]['currency'] = "RUB";
                  }
              }
              $i++;
          }
          if(!empty($order))
              $payer_data[$key]['orders']['order'] = $order;
    	}
    	$order_info['payer_companies']['company']  = $payer_data;
		
      $this->_gen_data  = $order_info;
      return $this;
        // //$data['funct'] = function($number){ return $this->money->exec($number);};

		
	}
  public function generate(){
      return $this->setData()->saveAsXml();
  }
	public function save($name,$path){
	    return $this->saveAsXml($name,$path);
	}
  public function saveAsString(){
      return $this->saveAsXmlString();
  }
	protected function getData(){
	   	return $this->_gen_data;
	}

	
	 

}
