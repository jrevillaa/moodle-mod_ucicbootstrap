<?php


//defined('MOODLE_INTERNAL') || die;
require_once("../../config.php");

//define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');


/*require_once($CFG->libdir.'/completionlib.php');

$decrypt = $_POST['data'];
$key = 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282';

$decrypt = explode('|', $decrypt.'|');
$decoded = base64_decode($decrypt[0]);
$iv = base64_decode($decrypt[1]);
if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
$key = pack('H*', $key);
$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
$mac = substr($decrypted, -64);
$decrypted = substr($decrypted, 0, -64);
$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
if($calcmac!==$mac){ return false; }
$decrypted = unserialize($decrypted);



$data = json_decode($decrypted);



//$data = json_decode(mc_decrypt($_POST['data'], ENCRYPTION_KEY));


//esto es el coursemodule
$cm = $data[0];
//esto tiene que tener la info de la db en ucicbootstrap
$resource = $data[1];

$course = $data[2];





$context = context_module::instance($cm->id);
require_capability('mod/ucicbootstrap:view', $context);

$params = array(
    'context' => $context,
    'objectid' => $resource->id
);
$event = \mod_ucicbootstrap\event\course_module_viewed::create($params);
$event->add_record_snapshot('course_modules', $cm);
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('ucicbootstrap', $resource);
$event->trigger();

// Update 'viewed' state if required by completion system
$completion = new completion_info($course);
$completion->set_module_viewed($cm);
*/
echo 'VISTA YA CHECKEADA!';


/*
function mc_decrypt($decrypt, $key){
    $decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}*/