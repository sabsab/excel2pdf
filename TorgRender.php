<?php
/**
 * ��������� ������� TTH
 * @category classes
 * @package excel-template
 * @author: u.lebedev
 * @date: 06.03.13
 * @version    $Id: $
 */
require_once 'ExcelTemplateFacade.php';


class TorgRender{
    protected $data;
    const TEMPLATE_DIR = "templates/torg_12.xls";

    /**
     * ��������� ������ ��� �������
     * @return array
     */
    protected function getData (){
        if (NULL == $this->data){
            $params = array();
            // ��������� ��� �������� �����
            $data = array_fill(0, 150, array("name"=>"�����","1ckod"=>"000556", "qua_text"=>"���", "okei"=>"ok", "price_sum"=>100.2));
            $params = array(

                    "header"=>array(
                        'header'=>"��������������� ����� � ����-12 ���������� \n �������������� ����������� ������ �� 25.12.98 � 132",
                        'company_okud'=>"OKUD",
                        'company_okpo'=>"����",
                        'activity_okpo_suplier'=>"��������",
                        'receiver'=>"�������",
                        'payer'=>"����������",
                        'seller'=>"���������", //����� + �������
                        'recepient'=>"���������", //����� + �������
                        'base'=>"����",
                    ),

                    "data"=>$data,
                    "footer"=>array(
                        "director"=>"������� �.�",
                        "buhg"=>"�������� �.�"
                    )


            );

            $this->data = $params;
        }
        return $this->data;

    }

    /**
     * ��������� ����������� � ����������� ��� ������������ ������
     * @param null $invoice_id
     */
    public function __construct(){

    }
    public function convert($data){
        if (is_array($data)){
            foreach ($data as &$val){
                if (is_array($val)){
                    $val = $this->convert($val);
                }
                else {
                    $val = mb_convert_encoding ($val, "UTF-8", "CP1251");
                }

            }
        }
        else {
            $data = mb_convert_encoding ($data, "UTF-8","CP1251");
        }
        return $data;
    }
    /**
     * ��������� ��������
     * @return PHPReport
     */
    public function getRender(){
        $facade = new ExcelTemplateFacade(__DIR__. "/" . self::TEMPLATE_DIR);
        $renderer= $facade->getTemplater();
        $data = $this->getData();

        foreach ($data as $id=>$values){
            if ("data" == $id){
                //print_r($this->convert($values));
                $renderer->addData($id, $this->convert($values), true);
            }else {
                $renderer->addData($id, $this->convert($values));
            }


        }
        return $renderer;

    }

}