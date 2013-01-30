<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

$transaction = new nxcDIBSTransaction(
	array(
		'amount'        => 1000,
		'currency'      => 578,
		'order_id'      => rand( 99999, 9999999 ),
		'order_text'    => 'Order description',
		'settings_file' => 'dibs-test.ini'
	)
);
$transaction->store();

$transaction->setStatus( nxcDIBSTransaction::STATUS_REDIRECTED_TO_DIBS );
$transaction->store();

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );
echo $tpl->fetch( 'design:dibs/redirect.tpl' );
eZExecution::cleanExit();
