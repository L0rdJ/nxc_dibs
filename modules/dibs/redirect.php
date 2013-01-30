<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    26 Oct 2010
 **/

$transaction = nxcDIBSTransaction::fetch( $Params['transactionID'] );
if( !( $transaction instanceof nxcDIBSTransaction ) ) {
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}
$transaction->setStatus( nxcDIBSTransaction::STATUS_REDIRECTED_TO_DIBS );
$transaction->store();

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );
echo $tpl->fetch( 'design:dibs/redirect.tpl' );
eZExecution::cleanExit();
