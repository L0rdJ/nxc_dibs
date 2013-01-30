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

$http = eZHTTPTool::instance();
if( $http->hasVariable( 'transact' ) === false || $http->hasVariable( 'authkey' ) === false ) {
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$authKey = false;
if( $transaction->isKeyControlEnbaled() ) {
	$md5Key1 = $transaction->ini->variable( 'LocalShopSettings', 'MD5Key1' );
	$md5Key2 = $transaction->ini->variable( 'LocalShopSettings', 'MD5Ket2' );

	$authKey = md5(
		$md5Key2 . md5(
			$md5Key1 . 'transact=' . $_POST['transact'] . '&amount=' . $transaction->attribute( 'amount' ) . '&currency=' . $transaction->attribute( 'currency' )
		)
	);
}

$transaction->setStatus( nxcDIBSTransaction::STATUS_PAYMENT_DONE );
$transaction->setAttribute( 'transaction_id', $http->variable( 'transact' ) );
if( $authKey !== false ) {
	$transaction->setAttribute( 'auth_key', $authKey );
	if( $authKey != $http->variable( 'authkey' ) ) {
		$transaction->setStatus( nxcDIBSTransaction::STATUS_PAYMENT_FAILED );
	}
}
$transaction->store();

if( $transaction->attribute( 'status' ) == nxcDIBSTransaction::STATUS_PAYMENT_DONE ) {
	$paymentObject = eZPaymentObject::fetchByOrderID( $transaction->attribute( 'order_id' ) );
	if( $paymentObject instanceof eZPaymentObject ) {
		$paymentObject->approve();
		$paymentObject->store();
		eZPaymentObject::continueWorkflow( $paymentObject->attribute( 'workflowprocess_id' ) );
	}
}

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:dibs/accept.tpl' );
$Result['path']    = array(
	array(
		'text' => ezpI18n::tr( 'extension/dibs', 'DIBS Notification' ),
		'url'  => false
	)
);
