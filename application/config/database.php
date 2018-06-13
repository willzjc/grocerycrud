<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * ... mpla mpla mpla
 */

$active_group = 'default';
$active_record = TRUE;


$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'grocerycrud';
$db['default']['dbdriver'] = 'mysqli';
//$db['default']['dbdriver'] = 'postgres';
$db['default']['dsn'] = 'pgsql:host=localhost;port=5432;dbname=grocerycrud';

$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
$db['default']['failover'] = array();

/* End of file database.php */
/* Location: ./application/config/database.php */