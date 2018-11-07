<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Message.php");

$limit = 7; //number of messages to load


$message = new Message($con, $_REQUEST['userLoggedIn']); //$_REQUEST comes form the ajax call
echo $message->getConvosDropdown($_REQUEST, $limit);
?>