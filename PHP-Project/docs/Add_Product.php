<?php
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
}
$array = $_GET['array'];

        $object = ORM::getInstance();
		$object->setTable('categries');
		
		$queryOption=$object->update((array('options'=>$array)),1);
		

?>
