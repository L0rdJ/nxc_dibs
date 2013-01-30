<div class="context-block">
	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'Meta information'|i18n( 'extension/dibs' )}:</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		<div class="block">
			<label>{'ID'|i18n( 'extension/dibs' )}:</label> {$transaction.id}
		</div>

		<div class="block">
			<label>{'Status'|i18n( 'extension/dibs' )}:</label> {$transaction.status_description}
		</div>

		{if $transaction.user}
		<div class="block">
			<label>{'Customer'|i18n( 'extension/dibs' )}:</label> {content_view_gui view=text_linked content_object=$transaction.user}
		</div>
		{/if}

		<div class="block">
			<label>{'Customer IP'|i18n( 'extension/dibs' )}:</label> {$transaction.user_ip_string}
		</div>

		<div class="block">
			<label>{'Created'|i18n( 'extension/dibs' )}:</label> {$transaction.created|datetime('custom','%d.%m.%Y %H:%i:%s')}
		</div>

		<div class="block">
			<label>{'Changed'|i18n( 'extension/dibs' )}:</label> {$transaction.changed|datetime('custom','%d.%m.%Y %H:%i:%s')}
		</div>

		<div class="block">
			<label>{'Used settings file'|i18n( 'extension/dibs' )}:</label> {$transaction.settings_file}
		</div>

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>

<div class="context-block">
	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'Payment options'|i18n( 'extension/dibs' )}:</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		<div class="block">
			<label>{'Merchant\'s account number'|i18n( 'extension/dibs' )}:</label> {$transaction.merchant}
		</div>

		<div class="block">
			<label>{'Payment amount'|i18n( 'extension/dibs' )}:</label> {$transaction.amount|div( 100 )}
		</div>

		<div class="block">
			<label>{'Currency code'|i18n( 'extension/dibs' )}:</label> {$transaction.currency}
		</div>

		{if $transaction.order}
		<div class="block">
			<label>{'Order ID'|i18n( 'extension/dibs' )}:</label> <a href="{concat( '/shop/orderview/', $transaction.order.id, '/' )|ezurl( 'no' )}">{$transaction.order.order_nr}</a>
		</div>
		{/if}

		{if $transaction.payment_type}
		<div class="block">
			<label>{'Payment type'|i18n( 'extension/dibs' )}:</label>{$transaction.payment_type}
		</div>
		{/if}

		<div class="block">
			<label>{'Unique order ID'|i18n( 'extension/dibs' )}:</label>{if $transaction.unique_order_id}{'yes'|i18n( 'extension/dibs' )}{else}{'no'|i18n( 'extension/dibs' )}{/if}
		</div>

		{if $transaction.account}
		<div class="block">
			<label>{'Account'|i18n( 'extension/dibs' )}:</label>{$transaction.account}
		</div>
		{/if}

		<div class="block">
			<label>{'Capture now'|i18n( 'extension/dibs' )}:</label>{if $transaction.capture_now}{'yes'|i18n( 'extension/dibs' )}{else}{'no'|i18n( 'extension/dibs' )}{/if}
		</div>

		<div class="block">
			<label>{'Testmode'|i18n( 'extension/dibs' )}:</label>{if $transaction.test}{'yes'|i18n( 'extension/dibs' )}{else}{'no'|i18n( 'extension/dibs' )}{/if}
		</div>

		{if $transaction.language}
		<div class="block">
			<label>{'Language'|i18n( 'extension/dibs' )}:</label> {$transaction.language}
		</div>
		{/if}

		{if $transaction.color}
		<div class="block">
			<label>{'Color'|i18n( 'extension/dibs' )}:</label> {$transaction.color}
		</div>
		{/if}

		{if $transaction.calc_fee}
		<div class="block">
			<label>{'Calc fee'|i18n( 'extension/dibs' )}:</label> {$transaction.calc_fee}
		</div>
		{/if}

		{if $transaction.order_text}
		<div class="block">
			<label>{'Order description'|i18n( 'extension/dibs' )}:</label> {$transaction.order_text}
		</div>
		{/if}

		{if $transaction.md5_key}
		<div class="block">
			<label>{'MD5 Key'|i18n( 'extension/dibs' )}:</label> {$transaction.md5_key}
		</div>
		{/if}

		<div class="block">
			<label>{'Accept URL'|i18n( 'extension/dibs' )}:</label> {$transaction.accept_url|ezurl( 'no', 'full' )}
		</div>

		<div class="block">
			<label>{'Cancel URL'|i18n( 'extension/dibs' )}:</label> {$transaction.cancel_url|ezurl( 'no', 'full' )}
		</div>

		<div class="block">
			<label>{'Callback URL'|i18n( 'extension/dibs' )}:</label> {$transaction.callback_url|ezurl( 'no', 'full' )}
		</div>

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>

{if $transaction.transaction_id}
<div class="context-block">
	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'Success response values'|i18n( 'extension/dibs' )}:</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		{if $transaction.transaction_id}
		<div class="block">
			<label>{'DIBS transaction identification'|i18n( 'extension/dibs' )}:</label> {$transaction.transaction_id}
		</div>
		{/if}

		{if $transaction.auth_key}
		<div class="block">
			<label>{'AUTH Key'|i18n( 'extension/dibs' )}:</label> {$transaction.auth_key}
		</div>
		{/if}

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>
{/if}

{def $log_messages = $transaction.log_messages}
{if gt( $log_messages|count(), 0 )}
<div class="context-block">
	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'Transaction\'s log'|i18n( 'extension/dibs' )}:</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		<div class="block">
			<ol>
				{foreach $transaction.log_messages as $logMessage}
				<li>{$logMessage.message}</li>
				{/foreach}
			</ol>
		</div>

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>
{/if}
{undef $log_messages}