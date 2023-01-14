
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config["app_name"] = "Lovvit ID";
$config["version"] = "1.0";

// API configurations

// API credentials local/staging
$config["api_server"]       = "http://credentials.tgo.co.id:8010/api/";
$config["app_id"]           = "APP/0004";
$config["server_id"]        = "SVR-0017";
$config["validity_seconds"] = "500";

// API credentials production
// $config["api_server"]       = "http://159.65.1.139:8080/credential_services/api/";
// $config["app_id"]           = "APP/0005";
// $config["server_id"]        = "SVR-0018";
$config["validity_seconds"] = "500";

// API lovvit hq
$config["api_server_hq"]    = "http://staging.tgo.co.id/lovvit_id_hq/api/";

// $config["api_server_hq"]    = "https://hq.lovvit.id/api/";
$config["api_key_hq"]       = "AE^TxYVgL9NPaf!Y^_n&theMGVG#7^9@";
$config["app_id_hq"]        = "app.lovvit.id";

// API wa bot
$config["host"]             = "http://167.99.30.67/regular_api/";
