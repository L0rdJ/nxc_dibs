<?php
/**
 * @package nxcDIBS
 * @class   nxcDIBSTransaction
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

class nxcDIBSTransaction extends eZPersistentObject
{
	const STATUS_OBJECT_CREATED     = 1;
	const STATUS_OBJECT_STORED      = 2;
	const STATUS_REDIRECTED_TO_DIBS = 3;
	const STATUS_CANCELED_BY_USER   = 4;
	const STATUS_PAYMENT_DONE       = 5;
	const STATUS_PAYMENT_FAILED     = 6;

	public static $defaultFields = array(
		'merchant',
		'currency',
		'payment_type',
		'unique_order_id',
		'account',
		'capture_now',
		'test',
		'language',
		'color',
		'calc_fee',
		'accept_url',
		'cancel_url',
		'callback_url'
	);

	public static $boolFields = array(
		'unique_order_id',
		'capture_now',
		'test'
	);

	public $ini;

	public function __construct( $row = array() ) {
		$this->eZPersistentObject( $row );

		if( $this->attribute( 'settings_file' ) === null ) {
			$this->setAttribute( 'settings_file', 'dibs.ini' );
		}
		$this->ini = eZINI::instance( $this->attribute( 'settings_file' ) );

		if( $this->attribute( 'id' ) === null ) {
			foreach( self::$defaultFields as $field ) {
				if( $this->attribute( $field ) === null ) {
					$iniField = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $field ) ) );
					if( $this->ini->hasVariable( 'LocalShopSettings', $iniField ) ) {
						$value = $this->ini->variable( 'LocalShopSettings', $iniField );
						if( in_array( $field, self::$boolFields ) ) {
							$value = in_array( $value, array( 'yes', 'true', 'enabled' ) ) ? 1 : 0;
						}

						if( $value !== '' ) {
							$this->setAttribute( $field, $value );
						}
					}
				}
			}

			$defaultURLs = array(
				'accept_url' => '/dibs/accept',
				'cancel_url' => '/dibs/cancel'
			);
			foreach( $defaultURLs as $field => $url ) {
				if( $this->attribute( $field ) === null ) {
					$this->setAttribute( $field, $url );
				}
			}

			$this->setAttribute( 'user_id', eZUser::currentUserID() );
			$this->setAttribute( 'user_ip', ip2long( $_SERVER['REMOTE_ADDR'] ) );
			$this->setAttribute( 'status', self::STATUS_OBJECT_CREATED );
			$this->setAttribute( 'created', time() );

			if( $this->isKeyControlEnbaled() ) {
				$md5Key1 = $this->ini->variable( 'LocalShopSettings', 'MD5Key1' );
				$md5Key2 = $this->ini->variable( 'LocalShopSettings', 'MD5Ket2' );

				$this->setAttribute(
					'md5_key',
					md5(
						$md5Key2 . md5(
							$md5Key1 . 'merchant=' . $this->attribute( 'merchant' ) . '&orderid=' . $this->attribute( 'order_id' ) . '&currency=' . $this->attribute( 'currency' ) . '&amount=' . $this->attribute( 'amount' )
						)
					)
				);
			}
		}

		foreach( self::$boolFields as $field ) {
			$this->setAttribute( $field, ( (bool) $this->attribute( $field ) ) );
		}
	}

	public static function definition() {
		return array(
			'fields'              => array(
				/**
				 * Meta fields
				 **/
				'id' => array(
					'name'     => 'id',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'status' => array(
					'name'     => 'status',
					'datatype' => 'integer',
					'default'  => self::STATUS_OBJECT_CREATED,
					'required' => true
				),
				'user_id' => array(
					'name'     => 'userID',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'user_ip' => array(
					'name'     => 'userIP',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'created' => array(
					'name'     => 'created',
					'datatype' => 'integer',
					'default'  => time(),
					'required' => true
				),
				'changed' => array(
					'name'     => 'changed',
					'datatype' => 'integer',
					'default'  => time(),
					'required' => true
				),
				'settings_file' => array(
					'name'     => 'settingsFile',
					'datatype' => 'string',
					'default'  => 'dibs.ini',
					'required' => true
				),
				'extra_data' => array(
					'name'     => 'extraData',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				/**
				 * Transaction attributes
				 **/
				'merchant' => array(
					'name'     => 'merchant',
					'datatype' => 'string',
					'default'  => 0,
					'required' => true
				),
				'amount' => array(
					'name'     => 'amount',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'currency' => array(
					'name'     => 'currency',
					'datatype' => 'integer',
					'default'  => 578,
					'required' => true
				),
				'order_id' => array(
					'name'     => 'orderID',
					'datatype' => 'int',
					'default'  => 0,
					'required' => true
				),
				'payment_type' => array(
					'name'     => 'paymentType',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'unique_order_id' => array(
					'name'     => 'uniqueOrderID',
					'datatype' => 'int',
					'default'  => 1,
					'required' => false
				),
				'account' => array(
					'name'     => 'account',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'capture_now' => array(
					'name'     => 'captureNow',
					'datatype' => 'int',
					'default'  => 1,
					'required' => false
				),
				'test' => array(
					'name'     => 'test',
					'datatype' => 'int',
					'default'  => 0,
					'required' => false
				),
				'language' => array(
					'name'     => 'language',
					'datatype' => 'string',
					'default'  => 'en',
					'required' => false
				),
				'color' => array(
					'name'     => 'color',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'calc_fee' => array(
					'name'     => 'calcFee',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'order_text' => array(
					'name'     => 'orderText',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'md5_key' => array(
					'name'     => 'md5Key',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'accept_url' => array(
					'name'     => 'acceptURL',
					'datatype' => 'string',
					'default'  => '',
					'required' => true
				),
				'cancel_url' => array(
					'name'     => 'cancelURL',
					'datatype' => 'string',
					'default'  => '',
					'required' => true
				),
				'callback_url' => array(
					'name'     => 'callbackURL',
					'datatype' => 'string',
					'default'  => '',
					'required' => true
				),
				/**
				 * Auth attributes
				 **/
				'transaction_id' => array(
					'name'     => 'transactionID',
					'datatype' => 'string',
					'default'  => '',
					'required' => false
				),
				'auth_key' => array(
					'name'     => 'authKey',
					'datatype' => 'string',
					'default'  => '',
					'required' => false
				)
			),
			'function_attributes' => array(
				'status_description' => 'getStatusDescription',
				'user'               => 'getUser',
				'user_ip_string'     => 'getUserIPString',
				'order'              => 'getOrder',
				'log_messages'       => 'getLogMessages'
			),
			'keys'                => array( 'id' ),
			'sort'                => array( 'id' => 'desc' ),
			'increment_key'       => 'id',
			'class_name'          => 'nxcDIBSTransaction',
			'name'                => 'nxc_dibs_transactions'
		);
	}

	public static function fetch( $id ) {
		return eZPersistentObject::fetchObject(
			self::definition(),
			null,
			array( 'id' => $id ),
			true
		);
	}

	public static function fetchByOrderID( $orderID ) {
		return eZPersistentObject::fetchObject(
			self::definition(),
			null,
			array( 'order_id' => $transactionID ),
			true
		);
	}

	public function isKeyControlEnbaled() {
		return $this->ini->hasVariable( 'LocalShopSettings', 'UseMD5keyControl' ) &&
			in_array( $this->ini->variable( 'LocalShopSettings', 'UseMD5keyControl' ), array( 'yes', 'true', 'enabled' ) ) &&
			$this->ini->hasVariable( 'LocalShopSettings', 'MD5Key1' ) &&
			$this->ini->hasVariable( 'LocalShopSettings', 'MD5Ket2' );
	}

	public function store( $fieldFilters = null ) {
		$this->setAttribute( 'changed', time() );

		foreach( self::$boolFields as $field ) {
			$this->setAttribute( $field, ( $this->attribute( $field ) ) ? 1 : 0 );
		}

		eZPersistentObject::storeObject( $this, $fieldFilters );

		if( $this->attribute( 'status' ) == self::STATUS_OBJECT_CREATED ) {
			$this->setAttribute( 'accept_url', $this->attribute( 'accept_url' ) . '/' . $this->attribute( 'id' ) );
			$this->setAttribute( 'cancel_url', $this->attribute( 'cancel_url' ) . '/' . $this->attribute( 'id' ) );
			$this->setAttribute( 'callback_url', $this->attribute( 'callback_url' ) . '/' . $this->attribute( 'id' ) );

			$this->setStatus( self::STATUS_OBJECT_STORED );
			eZPersistentObject::storeObject( $this, $fieldFilters );
		}

		foreach( self::$boolFields as $field ) {
			$this->setAttribute( $field, (bool) $this->attribute( $field ) );
		}
	}

	public function setStatus( $statusID ) {
		$oldStatusDescription = $this->attribute( 'status_description' );
		$this->setAttribute( 'status', $statusID );
		$newStatusDescription = $this->attribute( 'status_description' );

		$this->debug( 'Changing transaction`s status from "' . $oldStatusDescription . '" to "' . $newStatusDescription . '"' );
	}

	public function getStatusDescription() {
		switch( $this->attribute( 'status' ) ) {
			case self::STATUS_OBJECT_CREATED:
				return ezpI18n::tr( 'extension/dibs', 'Object created' );
			case self::STATUS_OBJECT_STORED:
				return ezpI18n::tr( 'extension/dibs', 'Object stored' );
			case self::STATUS_REDIRECTED_TO_DIBS:
				return ezpI18n::tr( 'extension/dibs', 'User redirected to DIBS' );
			case self::STATUS_CANCELED_BY_USER:
				return ezpI18n::tr( 'extension/dibs', 'Canceled by user' );
			case self::STATUS_PAYMENT_DONE:
				return ezpI18n::tr( 'extension/dibs', 'Payment done' );
			case self::STATUS_PAYMENT_FAILED:
				return ezpI18n::tr( 'extension/dibs', 'Payment failed' );
    	}
	}

	public function getUser() {
		return eZContentObject::fetch( $this->attribute( 'user_id' ) );
	}

	public function getUserIPString() {
		return long2ip( $this->attribute( 'user_ip' ) );
	}

	public function getOrder() {
		return eZOrder::fetch( $this->attribute( 'order_id' ) );
	}

	public function getLogMessages() {
		return eZPersistentObject::fetchObjectList(
			nxcDIBSLogMessage::definition(),
			null,
			array( 'transaction_id' => $this->attribute( 'id' ) ),
			true
		);
	}

	public function debug( $message, $verbosityLevel = eZDebug::LEVEL_DEBUG ) {
		$fileData = array( 'var/log/', 'dibs.log' );

		$debug = eZDebug::instance();
		$debug->writeFile( $fileData, $message, $verbosityLevel );
		eZDebug::writeDebug( $message, 'DIBS Transaction' );

		$logMessage = new nxcDIBSLogMessage(
			array(
				'transaction_id' => $this->attribute( 'id' ),
				'message'        => $message
			)
		);
		$logMessage->store();
	}
}
