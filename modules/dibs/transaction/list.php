<?php
/**
 * @package nxcDIBS
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

$transactions = eZPersistentObject::fetchObjectList(
	nxcDIBSTransaction::definition()
);

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transactions', $transactions );

$Result = array();
$Result['content']   = $tpl->fetch( 'design:dibs/transaction/list.tpl' );
$Result['left_menu'] = 'design:parts/dibs/menu.tpl';
$Result['path']      = array(
	array(
		'text' => ezpI18n::tr( 'extension/dibs', 'DIBS Transactions' ),
		'url'  => false
	)
);
