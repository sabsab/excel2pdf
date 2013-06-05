<?php
/**
 * Фасад к рендереру excel шаблонов
 * @category classes
 * @package excel-template
 * @author: u.lebedev
 * @date: 06.03.13
 * @version    $Id: $
 */
require_once 'lib/PHPExcel/Classes/PHPExcel.php';
require_once 'lib/PHPReport/PHPReport.php';

define ("_MPDF_CONFIG_PATH", dirname(preg_replace('/\\\\/','/',__FILE__)) . '/config/mpdf/');
define ("_MPDF_TTFONTPATH", dirname(preg_replace('/\\\\/','/',__FILE__)) . '/config/mpdf/ttfonts/');
define ("_MPDF_TTFONTDATAPATH", dirname(preg_replace('/\\\\/','/',__FILE__)) . '/config/mpdf/ttfontdata/');

class ExcelTemplateFacade {
    /**
     *
     * @var string путь к шаблону
     */
    protected $absTemplatePath;
    protected $templater;

    /**
     * Путь к шаблону
     * @param $absTemplatePath
     */
    public function __construct ($absTemplatePath){
        $this->setAbsTemplatePath($absTemplatePath);
    }

    /**
     * шаблонизатор
     * @param PHPReport $templater
     * @return ExcelTemplateFacade
     */
    protected function setTemplater( PHPReport $templater)
    {
        $this->templater = $templater;
        return $this;
    }

    /**
     * @return PHPReport
     */
    public function getTemplater(){
        if (NULL == $this->templater){

            PHPExcel_Settings::setPdfRenderer(
                PHPExcel_Settings::PDF_RENDERER_MPDF,
                realpath(dirname(__FILE__).'/lib/mpdf/')
            );
            PHPExcel_Settings::setLocale('ru');
            $templater = new PHPReport(
                array(
                    'templatePath'=>dirname($this->getAbsTemplatePath()) . "/",
                    'pdfRendererPath'=>"/lib/mpdf/",
                    'template'=>basename($this->getAbsTemplatePath())
                )
            );
            $this->templater = $templater;
        }
        return $this->templater;
    }
    /**
     * @param string $absTemplatePath
     */
    protected function setAbsTemplatePath($absTemplatePath)
    {
        $this->absTemplatePath = $absTemplatePath;
        return $this;
    }

    /**
     * @return string
     */
    protected function getAbsTemplatePath()
    {
        return $this->absTemplatePath;
    }

}