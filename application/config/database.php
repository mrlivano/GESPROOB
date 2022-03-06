<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group  = 'default';
$query_builder = true;

$db['default'] = array(
   'dsn'          => '',
   'hostname'     => 'WIN-66HFFS0RNAC', //'20.0.20.100',
   'username'     => 'sa',
   'password'     => '123456789',
   'database'     => 'SMP_GRA', //SMP_GRA -- DBSMP
   'dbdriver'     => 'sqlsrv',
   'dbprefix'     => '',
   'pconnect'     => false,
   'db_debug'     => (ENVIRONMENT !== 'production'),
   'cache_on'     => false,
   'cachedir'     => '',
   'char_set'     => 'utf8',
   'dbcollat'     => 'Modern_Spanish_CI_AS',
   'swap_pre'     => '',
   'encrypt'      => false,
   'compress'     => false,
   'stricton'     => false,
   'failover'     => array(),
   'save_queries' => true,
);


$db['lectura'] = array(
   'dsn'          => '',
   'hostname'     => 'WIN-66HFFS0RNAC', //'20.0.20.100',
   'username'     => 'sa',
   'password'     => '123456789',
   'database'     => 'SMP_GRA',
   'dbdriver'     => 'sqlsrv',
   'dbprefix'     => '',
   'pconnect'     => false,
   'db_debug'     => (ENVIRONMENT !== 'production'),
   'cache_on'     => false,
   'cachedir'     => '',
   'char_set'     => 'utf8',
   'dbcollat'     => 'Modern_Spanish_CI_AS',
   'swap_pre'     => '',
   'encrypt'      => false,
   'compress'     => false,
   'stricton'     => false,
   'failover'     => array(),
   'save_queries' => true,
);


$db['escritura'] = array(
   'dsn'          => '',
   'hostname'     => 'WIN-66HFFS0RNAC', //'20.0.20.100',
   'username'     => 'sa',
   'password'     => '123456789',
   'database'     => 'SMP_GRA',
   'dbdriver'     => 'sqlsrv',
   'dbprefix'     => '',
   'pconnect'     => false,
   'db_debug'     => (ENVIRONMENT !== 'production'),
   'cache_on'     => false,
   'cachedir'     => '',
   'char_set'     => 'utf8',
   'dbcollat'     => 'Modern_Spanish_CI_AS',
   'swap_pre'     => '',
   'encrypt'      => false,
   'compress'     => false,
   'stricton'     => false,
   'failover'     => array(),
   'save_queries' => true,
);


$db['SIGA_SEDECENTRAL'] = array(
    'dsn'          => '',
    'hostname'     => '192.168.1.49',
    'username'     => 'sa',
    'password'     => 'TestUniq2021$$',
    'database'     => 'SIGA_1549',
    'dbdriver'     => 'sqlsrv',
    'dbprefix'     => '',
    'pconnect'     => false,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => false,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'Modern_Spanish_CI_AS',
    'swap_pre'     => '',
    'encrypt'      => false,
    'compress'     => false,
    'stricton'     => false,
    'failover'     => array(),
    'save_queries' => true,
);

