<?php 
/*
 * Библиотека для работы с mPDF;
 * 
 */
require_once ('mpdf/mpdf.php');
class Pdf{
    private $_html;
    private $_css;
    private $_template;
    private $_status;
    
//    function __get($var){
//        return get_instance()->$var;
//    }
    function generatePdf($dest='',$name='',$path=''){
        $mpdf=new mPDF('utf-8','A4','','',20,15,20,16); 
        $mpdf->charset_in = 'utf-8';
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
        //$this->loadTemplate($template, $data);
        if(isset($this->_template)) {
       // $stylesheet = file_get_contents('table.css');
            if(isset($this->_css))
                $mpdf->WriteHTML($this->_css,1);    // The parameter 1 tells that this is css/style only and no body/html/text
            if(isset($this->_html)){
                $mpdf->WriteHTML($this->_html,2);
                $pref_path = "include/attachments/files/pdf";
                if(!is_dir($pref_path)){
                    mkdir($pref_path, 0777);
                }
                $path = (!empty($path))?'include/attachments/files/pdf/'.$path.'/':'include/attachments/files/pdf/';
                if(!is_dir($path)){
                    mkdir($path, 0777);
                }
                $name = (!empty($name))?$name:'PDF';
                $fullpathname = $path.$name.'.pdf';
                $mpdf->Output($fullpathname,$dest);
                return $fullpathname;
            }
        }
        return FALSE;
    }
    //$html - путь до шаблона
    private function loadHtml($html,$data){
        $CI =& get_instance();
        $html = $CI->load->view($html,$data,true);
//       / $html = load->view();
         $this->_html=$html;
    } 
    //$css - путь до стилей для шаблона
    private function loadCss($css){
        $this->_css =  file_get_contents($css);
    }
    function loadTemplate($template,$data){
        
        $html_path = 'pdf_templates/'.$template.'/index';
        $css =  'include/pdf-templates-style/'.$template.'/style.css';
        $file = is_file('application/views/'.$html_path.'.php')?$html_path:(is_file('application/views/'.$html_path.'.html')?$html_path.'.html':FALSE);
        
        if($file){
            $this->_template=$template;
            $this->loadHtml($file, $data);
        }
        if(is_file($css)) $this->loadCss($css);
        return $this;
    }
    function status(){
        return $this->_status;
    }
}

