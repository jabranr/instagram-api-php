<?php

/**
 *
 * Instagram API PHP Class
 * @version: 0.0.1
 * @author: hello@jabran.me
 * @url: http://github.com/jabranr
 * @website: http://jabran.me
 * @package: Making life easier!
 * 
 * @license: MIT License
 * 
 * Copyright (c) 2013 Jabran Rafique
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation 
 * files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software
 * is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be 
 * included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
 * FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 */


class JRIG	{
	
	private $options = array();
	
	// @override: Default construct method
	public function __construct( $client_id = IGCID, $client_secret = IGCS, $redirect_uri = IGRURI, $scope = IGSCOPE )	{

		$this->options = array(
			'client_id' => '',
			'client_secret' => '',
			'access_token' => '',
			'redirect_uri' => '',
			'api_uri' => '',
			'oauth_url' => '',
			'oauth_uri' => '',
			'access_token_uri' => '',
			'grant_type' => '',
			'scope' => '',
			'endpoint' => '' );

		$this->__init( $client_id, $client_secret, $redirect_uri, $scope );

	}
	
	// Initialising method
	private function __init( $client_id = '', $client_secret = '', $redirect_uri = '', $scope = '' )	{
		$this->__set('client_id', $client_id);
		$this->__set('client_secret', $client_secret);
		$this->__set('redirect_uri', $redirect_uri);
		$this->__set('scope', $scope);
		$this->__set('api_uri', IGAPI);
		$this->__set('access_token_uri', IGAPI . IGTOKENURI);
		$this->__set('oauth_url', IGAPI . IGOAUTH);
		
		$oauth_uri = $this->__get('oauth_url');
		$oauth_uri .= '?client_id=' . $client_id;
		$oauth_uri .= '&redirect_uri=' . $redirect_uri;
		$oauth_uri .= '&response_type=code';
		$oauth_uri .= empty($scope) ? '' : '&scope=' . $scope;
		
		$this->__set('oauth_uri', $oauth_uri);
		
		$this->__set('grant_type', IGGT);
		$this->__set('endpoint', IGAPI . IGEP);
	}
		
	// @override: Default magic GET method
	public function __get( $option )	{

		return $this->options[$option];

	}
	
	// @override: Default magic SET method
	public function __set( $option, $value )	{
		
		if ( array_key_exists( $option, $this->options ) )	{
			$this->options[$option] = $value;
		}
		
	}
	
	/* Get access token after recieved as $_GET['code']
	 * @param: Code returned from Instagram OAuth URI
	 * @return: Array() consist of user basic data
	 */
	public function get_access_token( $code )	{
		if ( !empty($code) )	{
			
			$curl = curl_init();
			curl_setopt_array( $curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $this->__get('access_token_uri'),
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => array(
					'client_id' => $this->__get('client_id'),
					'client_secret' => $this->__get('client_secret'),
					'grant_type' => $this->__get('grant_type'),
					'redirect_uri' => $this->__get('redirect_uri'),
					'code' => $code
				)
			));
			
			$data = array();
			
			if ( $output = curl_exec( $curl ) )	{

				$output = json_decode( $output );

				$data = array(
					'user_id' => $output->user->id,
					'username' => $output->user->username,
					'name' => $output->user->full_name,
					'avatar' => $output->user->profile_picture,
					'access_token' => $output->access_token
				);

			$this->__set( 'access_token', $data['access_token'] );

			}
			curl_close( $curl );
			return $data;
		}
		return false;
	}
	
	// Get the Instagram OAuth URI
	public function get_oauth_uri()	{
		return $this->__get('oauth_uri');
	}

	// Get the Instagram client_id
	public function get_client_id()	{
		return $this->__get('client_id');
	}

	// Get the Instagram client_secret
	public function get_client_secret()	{
		return $this->__get('client_secret');
	}

	// Get the Instagram redirect uri
	public function get_redirect_uri()	{
		return $this->__get('redirect_uri');
	}

	// Get the Instagram scope
	public function get_scope()	{
		return $this->__get('scope');
	}
	
	// Get search results for media
	public function searchMedia( $lat= '', $lng = '', $min_timestamp = '', $max_timestamp = '', $distance = '' )	{
		
		$url = $this->__get('endpoint') . 'media/search?';
		$url .= ( $this->__get('access_token') ) ? 'access_token=' : '';
		$url .= ( !empty($lat) && (is_float($lat) || is_numeric($lat)) && !empty($lng) && (is_float($lng) || is_float($lng)) ) ? '&lat=' . $lat . '&lng=' . $lng : '';
		$url .= ( !empty($min_timestamp) ) ? '&=min_timestamp' . $min_timestamp : '';
		$url .= ( !empty($max_timestamp) ) ? '&=max_timestamp' . $max_timestamp : '';
		$url .= ( !empty($distance) ) ? '&distance=' . $distance : '';
		
		return $this->_curl_get( $url );
	}
	
	// Get media by ID
	public function searchById( $media_id = 0 )	{
		
		$url = $this->__get('endpoint') . 'media/';
		$url .= $media_id;
		$url .= '?access_token=' . $this->__get('access_token');
		
		return $this->_curl_get( $url );		
	}
	
	// Get media by popularity
	public function searchByPopularity()	{
		
		$url = $this->__get('endpoint') . 'media/popular';
		$url .= '?access_token=' . $this->__get('access_token');

		return $this->_curl_get( $url );
	}
	
	// Get recently tagged media
	public function searchByTag( $tag = '' )	{
		if ( empty($tag) === false )	{
			$tag = htmlentities($tag);
			$url = $this->__get('endpoint') . 'tags/' . $tag . '/media/recent';
			$url .= '?access_token=' . $this->__get('access_token');
			
			return $this->_curl_get( $url );			
		}
		return false;
	}
	
	// Get results by tag search
	public function searchByTagName( $tag = '' )	{
		if ( empty($tag) === false )	{
			$tag = htmlentities($tag);
			$url = $this->__get('endpoint') . 'tags/search';
			$url .= '?q=' . $tag . '&access_token=' . $this->__get('access_token');
			
			return $url;
		}
		return false;
	}
		
	// CURL for GET requests
	private function _curl_get( $url )	{
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1
		) );
		
		if ( $output = curl_exec( $curl ) )
			$output = json_decode( $output );
		
		return $output;
	}
		
	// @override: Default destructor method
	public function __destruct()	{
		return true;
	}
}

?>