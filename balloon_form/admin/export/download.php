<?php
if(isset($_GET['file'])){
$form_id = $_GET['file'];
header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=export_".$form_id.".csv");

include 'export_'.$form_id.'.csv';
}
?>
