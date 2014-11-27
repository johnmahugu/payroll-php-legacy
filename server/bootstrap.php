<?php

$path = pathinfo(__FILE__);
define("ROOT",$path['dirname']."/");
define("MODELS",ROOT.'models/');

require_once(ROOT."lib/Doctrine.php");

spl_autoload_register(array('Doctrine', 'autoload'));

$manager = Doctrine_Manager::getInstance();
// At this point no actual connection to the database is created

// $dbh = new PDO('mysql:dbname=payroll3;host=localhost','root','root*');
$dbh = new PDO('mysql:dbname=903334_payroll;host=82.197.130.55','903334_payroll','payroll');
$conn = Doctrine_Manager::connection($dbh);
//$conn = Doctrine_Manager::connection('mysql://root:@localhost/payroll3','payroll3');

// The first time the connection is needed, it is instantiated
// This query triggers the connection to be created
$manager->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
$manager->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_ALL);
$manager->setAttribute(Doctrine::ATTR_MODEL_LOADING,Doctrine::MODEL_LOADING_CONSERVATIVE);
$manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);//for password accessor override to work
$manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);//for doctrine_table cls to be loaded
$manager->setAttribute(Doctrine::ATTR_QUOTE_IDENTIFIER, true);
$manager->setAttribute(Doctrine::ATTR_IDXNAME_FORMAT, '%s_sequence');

Doctrine::loadModels(MODELS."payroll3");
?>