<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (

			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "901259107062-gcdlj8umgliduqmjr1l8o0u3d629593u.apps.googleusercontent.com", "secret" => "hFCkd16zUX1GCmLvslJ3Dw6V" ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "1713690762052941", "secret" => "cfb5325aeb07414b0add69b7a7d770ec" ),
				//"scope"   => 'email, user_about_me, user_birthday, user_hometown, user_website, read_stream',
				"scope"   => 'email',
				"trustForwarded" => true
			),


		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => true,

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);
 
