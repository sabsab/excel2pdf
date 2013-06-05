<?php
/**
 * Ренедринг шаблона TTH
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
     * Формируем данные для шаблона
     * @return array
     */
    protected function getData (){
        if (NULL == $this->data){
            $params = array();
            // Параметры для создания счёта
            $result =  array(
                "header"=>array(
                    //'1. номер груза'
                    'stowage_number'=>1,
                    //как поставщик из Торг-12
                    'postawik'=>"Поставщик",
                    //3.= грузополучатель из торг-12
                    'gryzopolychatel'=>"Грузополучатель",
                    //4. = плательщик из торг-12
                    'platelwik'=>"Плательщик",
                    //5. = как и дата составления в торг-12
                    'date_sklad'=>"Дата склада",
                    //6. как и окпо в торг-12
                    'okpo'=>"123",
                ),
                "data"=>array(
                    'num' => 1,
                    'qua' => 1,
                    //9. товар народного потребления
                    'desc'=>'товар народного потребления',
                    //10. пусто
                    //11. меш.
                    'vid_upak'=>'меш.',
                    //12. =1
                    'mesto'=>1,

                    //13. = массе груза , т.е. `wms_operation_transfer_x_places`.`weight`
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
                    'pages_num'=>'один',
                    //18. = один
                    'names'=>'одно',
                    //19. одно
                    'mest'=>'одно',
                    //20. одно
                    //21.= 22. = прописью его вес из `wms_operation_transfer_x_places`.`weight`
                    'weigth_propis'=>'weight_propis',
                    //26. = `wms_operation_transfer_x_places`.`weight` / 1000
                    'weight_tonn'=>'weight_tonn',
                    //23.прописью `wms_operation_transfer_x_places`.`stat_cost` до рублей
                    'stat_cost_propis'=>'stat_cost_propis',
                    //24. цифрами - копейки отсюда `wms_operation_transfer_x_places`.`stat_cost`
                    'stat_cost_propis_kop'=>'stat_cost_propis_kop',
                    //25. Сивоплясова
                    'podpis'=>'Сивоплясова',
                    //с 26 по 29 - пустые'
                ),

            );

            $this->data = $result;
        }
        return $this->data;

    }

    /**
     * параметры необходимые и достаточные для формирования отчета
     * @param null $invoice_id
     */
    public function __construct(){

    }

    /**
     * Формируем рендерер
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