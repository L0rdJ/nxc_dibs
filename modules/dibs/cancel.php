<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    01 Nov 2010
 **/

$transaction = nxcDIBSTransaction::fetch( $Params['transactionID'] );
if( !( $transaction instanceof nxcDIBSTransaction ) ) {
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}
$transaction->setStatus( nxcDIBSTransaction::STATUS_CANCELED_BY_USER );
$transaction->store();

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:dibs/cancel.tpl' );
$Result['path']    = array(
	array(
		'text' => ezpI18n::tr( 'extension/dibs', 'DIBS Notification' ),
		'url'  => false
	)
);
