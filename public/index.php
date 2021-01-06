<?php 

if ( !session_id() ) {
    session_start();
}

require_once '../system/init.php';

$app = new App;