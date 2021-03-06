<?php

/**
 * @license GPL-2.0-or-later
 * @author H. Snater < mediawiki@snater.com >
 *
 * @codeCoverageIgnoreStart
 */
return call_user_func( function() {
	$moduleTemplate = [
		'localBasePath' => __DIR__ . '/../../wikibase-serialization/src',
		'remoteExtPath' => 'Wikibase/view/lib/wikibase-serialization/src',
	];

	$modules = [

		'wikibase.serialization' => $moduleTemplate + [
				'dependencies' => [
					'wikibase.serialization.__namespace',
					'wikibase.serialization.DeserializerFactory',
					'wikibase.serialization.SerializerFactory',
				],
			],

		'wikibase.serialization.__namespace' => $moduleTemplate + [
				'scripts' => [
					'__namespace.js',
				],
				'dependencies' => [
					'wikibase',
				],
			],

		'wikibase.serialization.DeserializerFactory' => $moduleTemplate + [
				'scripts' => [
					'DeserializerFactory.js',
				],
				'dependencies' => [
					'wikibase.serialization.__namespace',
					'wikibase.serialization.Deserializer',
					'wikibase.serialization.StrategyProvider',

					'wikibase.serialization.ClaimDeserializer',
					'wikibase.serialization.EntityDeserializer',
					'wikibase.serialization.FingerprintDeserializer',
					'wikibase.serialization.MultiTermDeserializer',
					'wikibase.serialization.MultiTermMapDeserializer',
					'wikibase.serialization.ReferenceDeserializer',
					'wikibase.serialization.ReferenceListDeserializer',
					'wikibase.serialization.SiteLinkDeserializer',
					'wikibase.serialization.SiteLinkSetDeserializer',
					'wikibase.serialization.SnakDeserializer',
					'wikibase.serialization.SnakListDeserializer',
					'wikibase.serialization.StatementDeserializer',
					'wikibase.serialization.StatementGroupDeserializer',
					'wikibase.serialization.StatementGroupSetDeserializer',
					'wikibase.serialization.StatementListDeserializer',
					'wikibase.serialization.TermDeserializer',
					'wikibase.serialization.TermMapDeserializer',
				],
			],

		'wikibase.serialization.SerializerFactory' => $moduleTemplate + [
				'scripts' => [
					'SerializerFactory.js',
				],
				'dependencies' => [
					'wikibase.serialization.__namespace',
					'wikibase.serialization.Serializer',
					'wikibase.serialization.StrategyProvider',

					'wikibase.serialization.ClaimSerializer',
					'wikibase.serialization.EntitySerializer',
					'wikibase.serialization.FingerprintSerializer',
					'wikibase.serialization.MultiTermMapSerializer',
					'wikibase.serialization.MultiTermSerializer',
					'wikibase.serialization.ReferenceListSerializer',
					'wikibase.serialization.ReferenceSerializer',
					'wikibase.serialization.SiteLinkSerializer',
					'wikibase.serialization.SiteLinkSetSerializer',
					'wikibase.serialization.SnakListSerializer',
					'wikibase.serialization.SnakSerializer',
					'wikibase.serialization.StatementGroupSerializer',
					'wikibase.serialization.StatementGroupSetSerializer',
					'wikibase.serialization.StatementListSerializer',
					'wikibase.serialization.StatementSerializer',
					'wikibase.serialization.TermMapSerializer',
					'wikibase.serialization.TermSerializer',
				],
			],

		'wikibase.serialization.StrategyProvider' => $moduleTemplate + [
				'scripts' => [
					'StrategyProvider.js',
				],
				'dependencies' => [
					'wikibase.serialization.__namespace',
				],
			],

	];

	return array_merge(
		$modules,
		require __DIR__ . '/Serializers/resources.php',
		require __DIR__ . '/Deserializers/resources.php'
	);
} );
