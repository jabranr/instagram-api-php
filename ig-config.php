<?php

/**
 * Instagram API configuration file
 * @version: 0.0.1
 * @author: hello@jabran.me
 * @url: http://github.com/jabranr
 * @website: http://jabran.me
 * @package: Making life easier!
 * 
 * @license: MIT License 
 *
 */


// Instagram Client ID
define( 'IGCID', '6ce4e473d32b46e7b59262b8a4819b1b' );

// Instagram Client Secret
define( 'IGCS', '51117a4657ad49e9b9f6f0bac62fd846' );

// Instagram Redirect URI
define( 'IGRURI', 'http://jabran.me/sandbox/igapi/' );

/** 
 * Instagram Scope / Permissons / 
 * Add permissions separated with + sign
 * Possible scopes are: likes, comments, relationships
 */
define( 'IGSCOPE', 'likes' );

// Instagram Grant Type
define( 'IGGT', 'authorization_code' );

// Instagram API URI
define( 'IGAPI', 'https://api.instagram.com/' );

// Instagram End Point
define( 'IGEP', 'v1/' );

// Instagram OAuth URI
define( 'IGOAUTH', 'oauth/authorize/' );

// Instagram Acces Token URI
define( 'IGTOKENURI', 'oauth/access_token' );


?>