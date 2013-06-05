<?php
date_default_timezone_set('Europe/Moscow');
mb_internal_encoding ("UTF-8");
require_once ("../ExcelTemplateFacade.php");
require_once ("../TorgRender.php");

$renderer = new TorgRender();
$renderer
    ->getRender()
    ->generateReport()
    //->renderXls("torg12.xls")
    ->renderPdf("torg1256.pdf");

