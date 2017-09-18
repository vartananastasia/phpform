<?php
include 'form-vau/start.php';

use Feedback\DB\DataBaseExecute as DB;

$registry->set ('db', new DB());
$registry->set ('template', new Template($registry));
$registry->set ('router', new Router($registry));

$registry['router']->setPath (site_path . 'controllers');

$registry['router']->delegate();