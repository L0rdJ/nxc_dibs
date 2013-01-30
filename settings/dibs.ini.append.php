<?php /* #?ini charset="utf-8"?

[Gateway]
# DIBS gateway URL
URL=https://payment.architrade.com/payment/start.pml

[LocalShopSettings]
# Shop identification. The Merchant number appears in the e-mail received from
# DIBS during registration with DIBS.
Merchant=XXXXXXXXXX
# Currency specification as indicated in ISO4217
# (http://tech.dibs.dk/toolbox/currency-codes/)
Currency=578
# The URL of the page to be displayed if the purchase is approved. 
AcceptUrl=/dibs/accept
# The URL of the page to be displayed if the customer cancels the payment.
CancelUrl=/dibs/cancel
# An optional ”server-to-server” call which tells the shop’s server that the
# payment was a success.
CallbackUrl=/dibs/callback
# Regarding the start-up of the DIBS Payment Window, the user can be limited
# to the use of just one particular payment form. This is accomplished by using
# the parameter “paytype”.
PaymentType=
# If this field exists, the orderid-field must be unique, i.e. there is no
# existing transaction with DIBS with the same order number.
# (http://tech.dibs.dk/toolbox/cardtype-paytype/)
UniqueOrderId=yes
# If multiple departments utilize the company’s acquirer agreement with PBS,
# it may prove practical to keep the transactions separate at DIBS. An ”account
# number” may be inserted in this field, so as to separate transactions at DIBS.
Account=
# If this field exists, an "instant capture" is carried out, i.e. the amount is
# immediately transferred from the customer’s account to the shop’s account.
CaptureNow=yes
# This field is used when tests are being conducted on the shop.
Test=yes
# Indicates the language to be used.
Language=en
# The basic colour of the Payment Window. There is currently a choice of 'sand',
# 'grey' and 'blue'.
Color=blue
# If the variable “calcfee” is declared (eg. calcfee=foo), the Payment Window
# will automatically affix the charge due to the transaction.
CalcFee=
# This variable enables an MD5 key control (http://tech.dibs.dk/?id=2672)
UseMD5keyControl=yes
MD5Key1=XXXXXXXXXX
MD5Ket2=XXXXXXXXXX
*/ ?>