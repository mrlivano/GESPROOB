<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group  = 'default';
$query_builder = true;

$db['default'] = array(
   'dsn'          => '',
   'hostname'     => 'DESKTOP-N1LQMHP', //'20.0.20.100',
   'username'     => 'my',
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
   'hostname'     => 'DESKTOP-N1LQMHP', //'20.0.20.100',
   'username'     => 'my',
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
   'hostname'     => 'DESKTOP-N1LQMHP', //'20.0.20.100',
   'username'     => 'my',
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

$db['SIGA_ANDAHUAYLAS'] = array(
   'dsn'          => '',
   'hostname'     => 'andahuaylas.ddns.net',
   'username'     => 'siga_747',
   'password'     => '747',
   'database'     => 'SIGA',
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
    'hostname'     => '10.19.0.3',
    'username'     => 'serversiga',
    'password'     => '$Sig@ue442%2017',
    'database'     => 'SIGA',
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

