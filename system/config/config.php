<?php

date_default_timezone_set(getenv('timezone'));

$env = getenv('ENVIRONMENT');

if ($env == 'development') {

   define('base_url', getenv('local_url'));
   error_reporting(E_ALL);

}else if ($env == 'staging') {

   define('base_url', getenv('staging_url'));

}else if ($env == 'production') {

   define('base_url', getenv('server_url'));
   error_reporting(0);

}