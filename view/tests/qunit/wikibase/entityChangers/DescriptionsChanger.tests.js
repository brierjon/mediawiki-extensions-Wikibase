/**
 * @license GPL-2.0-or-later
 * @author Adrian Heine <adrian.heine@wikimedia.de>
 */
( function ( sinon, wb, $ ) {
	'use strict';

	QUnit.module( 'wikibase.entityChangers.DescriptionsChanger', QUnit.newMwEnvironment() );

	var SUBJECT = wikibase.entityChangers.DescriptionsChanger;

	QUnit.test( 'is a function', function ( assert ) {
		assert.strictEqual(
			typeof SUBJECT,
			'function',
			'is a function.'
		);
	} );

	QUnit.test( 'is a constructor', function ( assert ) {
		assert.ok( new SUBJECT() instanceof SUBJECT );
	} );

	QUnit.test( 'setDescription performs correct API call', function ( assert ) {
		var api = {
			setDescription: sinon.spy( function () {
				return $.Deferred().promise();
			} )
		};
		var descriptionsChanger = new SUBJECT(
			api,
			{ getDescriptionRevision: function () { return 0; } },
			new wb.datamodel.Item( 'Q1' )
		);

		descriptionsChanger.setDescription( new wb.datamodel.Term( 'language', 'description' ) );

		assert.ok( api.setDescription.calledOnce );
	} );

	QUnit.test( 'setDescription correctly handles API response', function ( assert ) {
		var api = {
			setDescription: sinon.spy( function () {
				return $.Deferred().resolve( {
					entity: {
						descriptions: {
							language: {
								value: 'description'
							},
							lastrevid: 'lastrevid'
						}
					}
				} ).promise();
			} )
		};
		var descriptionsChanger = new SUBJECT(
			api,
			{ getDescriptionRevision: function () { return 0; }, setDescriptionRevision: function () {} },
			new wb.datamodel.Item( 'Q1' )
		);

		return descriptionsChanger.setDescription( new wb.datamodel.Term( 'language', 'description' ) )
		.done( function ( savedDescription ) {
			assert.strictEqual( savedDescription.getText(), 'description' );
		} );
	} );

	QUnit.test( 'setDescription correctly handles API failures', function ( assert ) {
		var api = {
			setDescription: sinon.spy( function () {
				return $.Deferred().reject( 'errorCode', { error: { code: 'errorCode' } } ).promise();
			} )
		};
		var descriptionsChanger = new SUBJECT(
			api,
			{ getDescriptionRevision: function () { return 0; }, setDescriptionRevision: function () {} },
			new wb.datamodel.Item( 'Q1' )
		);

		var done = assert.async();

		descriptionsChanger.setDescription( new wb.datamodel.Term( 'language', 'description' ) )
		.done( function ( savedDescription ) {
			assert.ok( false, 'setDescription should have failed' );
		} )
		.fail( function ( error ) {
			assert.ok( error instanceof wb.api.RepoApiError, 'setDescription did not fail with a RepoApiError' );
			assert.strictEqual( error.code, 'errorCode' );
		} )
		.always( done );
	} );

}( sinon, wikibase, jQuery ) );
