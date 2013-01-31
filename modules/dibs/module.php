<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

$Module = array(
	'name'            => 'DIBS Payment Gateway',
	'variable_params' => true
);

$ViewList = array(
	'test' => array(
		'functions' => array( 'pay' ),
		'script'    => 'test.php'
	),
	'redirect' => array(
		'functions' => array( 'pay' ),
		'script'    => 'redirect.php',
		'params'    => array( 'transactionID' )
	),
	'accept' => array(
		'functions' => array( 'pay' ),
		'script'    => 'accept.php',
		'params'    => array( 'transactionID' )
	),
	'cancel' => array(
		'functions' => array( 'pay' ),
		'script'    => 'cancel.php',
		'params'    => array( 'transactionID' )
	),
	'transactions' => array(
		'functions'               => array( 'admin' ),
		'script'                  => 'transaction/list.php',
		'default_navigation_part' => 'ezsetupnavigationpart'
	),
	'details' => array(
		'functions'               => array( 'admin' ),
		'script'                  => 'transaction/view.php',
		'params'                  => array( 'transactionID' ),
		'default_navigation_part' => 'ezsetupnavigationpart'
	)
);
$FunctionList = array(
	'pay'   => array(),
	'admin' => array()
);
