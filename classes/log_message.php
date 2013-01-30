<?php
/**
 * @package nxcDIBS
 * @class   nxcDIBSLogMessage
 * @author  Serhey Dolgushev <serhey.dolgushev@nxc.no>
 * @date    25 Oct 2010
 **/

class nxcDIBSLogMessage extends eZPersistentObject
{
	public function __construct( $row = array() ) {
		$this->eZPersistentObject( $row );

		if( $this->attribute( 'id' ) === null ) {
			$this->setAttribute( 'created', time() );
		}
	}

	public static function definition() {
		return array(
			'fields' => array(
				'id' => array(
					'name'     => 'id',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'transaction_id' => array(
					'name'     => 'transactionID',
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
				'message' => array(
					'name'     => 'message',
					'datatype' => 'string',
					'default'  => '',
					'required' => true
				)
			),
			'keys'                => array( 'id' ),
			'sort'                => array( 'id' => 'asc' ),
			'increment_key'       => 'id',
			'class_name'          => 'nxcDIBSLogMessage',
			'name'                => 'nxc_dibs_log_messages'
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
}
