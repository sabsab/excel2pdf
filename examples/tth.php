<?php
date_default_timezone_set('Europe/Moscow');
require_once ("../ExcelTemplateFacade.php");
require_once ("../TTHRender.php");

$renderer = new TTHRenderer();
$renderer->getRender()
    //->generateReport()
   // ->setActiveSheet(1)
    ->generateReport()
    //->renderXls("some2.xls")
    ->renderHtml("tth.html")
;