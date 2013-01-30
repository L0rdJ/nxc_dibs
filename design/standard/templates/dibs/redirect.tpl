<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>{'Redirect to DIBS payment gateway'|i18n( 'extension/dibs' )}</title>
	<style type="text/css">
	{literal}body {padding-top: 200px; text-align: center;}{/literal}
	</style>
</head>
<body>
	<form method="post" action="https://payment.architrade.com/payment/start.pml" id="redirect_form">
		<input type="hidden" name="merchant" value="{$transaction.merchant}" />
		<input type="hidden" name="amount" value="{$transaction.amount}" />
		<input type="hidden" name="currency" value="{$transaction.currency}" />
		{if $transaction.order_id}
		<input type="hidden" name="orderid" value="{$transaction.order_id}" />
		{/if}
		{if $transaction.payment_type}
		<input type="hidden" name="paytype" value="{$transaction.payment_type}" />
		{/if}
		{if eq( $transaction.unique_order_id, true() )}
		<input type="hidden" name="uniqueoid" value="yes" />
		{/if}
		{if $transaction.account}
		<input type="hidden" name="account" value="{$transaction.account}" />
		{/if}
		{if eq( $transaction.capture_now, true() )}
		<input type="hidden" name="capturenow" value="yes" />
		{/if}
		{if eq( $transaction.test, true() )}
		<input type="hidden" name="test" value="yes" />
		{/if}
		{if $transaction.language}
		<input type="hidden" name="lang" value="{$transaction.language}" />
		{/if}
		{if $transaction.color}
		<input type="hidden" name="color" value="{$transaction.color}" />
		{/if}
		{if $transaction.calc_fee}
		<input type="hidden" name="calcfee" value="{$transaction.calc_fee}" />
		{/if}
		{if $transaction.order_text}
		<input type="hidden" name="ordertext" value="{$transaction.order_text}" />
		{/if}
		{if $transaction.md5_key}
		<input type="hidden" name="md5key" value="{$transaction.md5_key}" />
		{/if}
		<input type="hidden" name="accepturl" value="{$transaction.accept_url|ezurl( 'no', 'full' )}" />
		<input type="hidden" name="cancelurl" value="{$transaction.cancel_url|ezurl( 'no', 'full' )}" />
		<input type="hidden" name="callbackurl" value="{$transaction.callback_url|ezurl( 'no', 'full' )}" />

		<noscript>
			<input type="submit" value="{'Click here to go to our credit card payment!'|i18n( 'extension/dibs' )}" />
		</noscript>
	</form>
	<script type="text/javascript">
	window.onload = function (evt) {ldelim} document.forms[0].submit(); {rdelim}
	</script>
</body>
</html>