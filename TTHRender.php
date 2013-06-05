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


class TTHRenderer{
    protected $data;
    const TEMPLATE_DIR = "templates/TTH.xls";

    /**
     * ��������� ������ ��� �������
     * @return array
     */
    protected function getData (){
        if (NULL == $this->data){
            $params = array();
            // ��������� ��� �������� �����
            $result =  array(
                "header"=>array(
                    //'1. ����� �����'
                    'stowage_number'=>1,
                    //��� ��������� �� ����-12
                    'postawik'=>"���������",
                    //3.= ��������������� �� ����-12
                    'gryzopolychatel'=>"���������������",
                    //4. = ���������� �� ����-12
                    'platelwik'=>"����������",
                    //5. = ��� � ���� ����������� � ����-12
                    'date_sklad'=>"���� ������",
                    //6. ��� � ���� � ����-12
                    'okpo'=>"123",
                ),
                "data"=>array(
                    'num' => 1,
                    'qua' => 1,
                    //9. ����� ��������� �����������
                    'desc'=>'����� ��������� �����������',
                    //10. �����
                    //11. ���.
                    'vid_upak'=>'���.',
                    //12. =1
                    'mesto'=>1,

                    //13. = ����� ����� , �.�. `wms_operation_transfer_x_places`.`weight`
                    'weight'=>'weight',
                    //14.`wms_operation_transfer_x_places`.`stat_cost`
                    'stat_cost'=>'stat_cost',
                    //15. wms_operation_transfer_x_places.barcode
                    'barcode'=>'barcopde',
                ),
                "footer"=>array(
                    //16. =1
                    'pages'=>1,
                    //17. wms_operation_transfer_x_places.barcode
                    'pages_num'=>'����',
                    //18. = ����
                    'names'=>'����',
                    //19. ����
                    'mest'=>'����',
                    //20. ����
                    //21.= 22. = �������� ��� ��� �� `wms_operation_transfer_x_places`.`weight`
                    'weigth_propis'=>'weight_propis',
                    //26. = `wms_operation_transfer_x_places`.`weight` / 1000
                    'weight_tonn'=>'weight_tonn',
                    //23.�������� `wms_operation_transfer_x_places`.`stat_cost` �� ������
                    'stat_cost_propis'=>'stat_cost_propis',
                    //24. ������� - ������� ������ `wms_operation_transfer_x_places`.`stat_cost`
                    'stat_cost_propis_kop'=>'stat_cost_propis_kop',
                    //25. �����������
                    'podpis'=>'�����������',
                    //� 26 �� 29 - ������'
                ),

            );

            $this->data = $result;
        }
        return $this->data;

    }

    /**
     * ��������� ����������� � ����������� ��� ������������ ������
     * @param null $invoice_id
     */
    public function __construct(){

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
            $renderer->addData($id, $values);

        }
        return $renderer;

    }

}