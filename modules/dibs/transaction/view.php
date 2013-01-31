<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

$module      = $Params['Module'];
$transaction = nxcDIBSTransaction::fetch( $Params['transactionID'] );
if( !( $transaction instanceof nxcDIBSTransaction ) ) {
	return $module->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:dibs/transaction/details.tpl' );
$Result['path']    = array(
	array(
		'text' => ezpI18n::tr( 'extension/dibs', 'DIBS Transactions' ),
		'url'  => 'dibs/transactions'
	),
	array(
		'text' => ezpI18n::tr( 'extension/dibs', 'Details' ),
		'url'  => false
	)
);
