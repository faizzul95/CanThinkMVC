<?php 

if ( !session_id() ) {
    session_start();
}

// Valid PHP Version?
$minPHPVersion = '7.3';
if (phpversion() < $minPHPVersion)
{
    die("Your PHP version must be {$minPHPVersion} or higher to run CanThink Framework. Current version: " . phpversion());
}
unset($minPHPVersion);

require_once '../system/init.php';

$app = new App;