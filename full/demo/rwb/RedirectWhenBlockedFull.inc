<?php
require 'multibyte.inc';
require 'rwb.appcache.functions.inc';

class RedirectWhenBlockedFull
{
	
	// This can't be used elsewhere on the website.
	const QUERY_STRING_PARAM_NAME = 'rwb3498472';
	
	// Same as above, used for anchors targeting top window.
	const TOP_WINDOW_NAME = self::QUERY_STRING_PARAM_NAME;
	
	// Used to identify main iframe.
	const IFRAME_WINDOW_NAME = 'rwb3498472i';

	const OUTPUT_TYPE_IFRAME = 1;

	const OUTPUT_TYPE_JSONP = 2;

	public static $translatable_text = array(
		'loading' => 'Loading...',
		'if_website_fails' => 'If the website fails to load, you may be able to find another
			mirror URL here:'
	);

	private static $alt_base_urls, $alt_url_collections;
	
	// If a part of the website uses a separate base URL.
	private static $base_url_suffix = '';
	
	// Shown on the cached page while the content is loading.
	private static $website_title;

	public static function getAltBaseUrls()
	{
		return self::$alt_base_urls;
	}
	
	// Guess the current base URL.
	public static function getBaseUrl()
	{
		$candidates = array();
		
		if (isset($_GET[self::QUERY_STRING_PARAM_NAME])) {
			$url = substr($_GET[self::QUERY_STRING_PARAM_NAME], 1);
			$candidates[] = $url;
		}
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			$candidates[] = $_SERVER['HTTP_ORIGIN'];
		}
		
		if (isset($_SERVER['HTTP_REFERER'])) {
			$candidates[] = $_SERVER['HTTP_REFERER'];
		}
		
		foreach ($candidates as $candidate) {
			foreach (self::$alt_base_urls as $alt_base_url) {
				if ($candidate && self::startsWith($candidate, $alt_base_url)) {
					return $alt_base_url;
				}
			}
		}
		
		return self::$alt_base_urls[0];
	}

	public static function getOutputType()
	{
		static $output_type;
		
		if (! isset($output_type)) {
			$output_type = isset($_GET[self::QUERY_STRING_PARAM_NAME]) ? $_GET[self::QUERY_STRING_PARAM_NAME][0] : NULL;
		}
		
		return $output_type;
	}
	
	// Because we append a custom query string parameter, the script may want to access
	// the "original" URI, with the custom query string parameter removed.
	public static function getRequestUriWithoutQueryStringParam()
	{
		$uri = $_SERVER['REQUEST_URI'];
		if (! isset($_GET[self::QUERY_STRING_PARAM_NAME])) {
			return $uri;
		}
		
		$get_copy = $_GET;
		unset($get_copy[self::QUERY_STRING_PARAM_NAME]);
		
		// If JSONP, remove other parameters added by jQuery.
		if (self::getOutputType() == self::OUTPUT_TYPE_JSONP) {
			if (isset($get_copy['callback'])) {
				unset($get_copy['callback']);
			}
			if (isset($get_copy['_'])) {
				unset($get_copy['_']);
			}
		}
		
		$uri_components = parse_url($uri);
		$uri = $uri_components['path'];
		
		if ($get_copy) {
			$uri .= '?' . http_build_query($get_copy);
		}
		
		if (isset($uri_components['fragment'])) {
			$uri .= '#' . $uri_components['fragment'];
		}
		
		return $uri;
	}
	
	// Main activity.
	public static function run()
	{
		
		/*
		 * Normal request. Substitute the response with our own page.
		 */
		if (! isset($_GET[self::QUERY_STRING_PARAM_NAME])) {
			
			$iframe_src = $_SERVER['REQUEST_URI'];
			if ($_SERVER['QUERY_STRING']) {
				$iframe_src .= '&';
			} else {
				$iframe_src .= '?';
			}
			
			$iframe_src .= self::QUERY_STRING_PARAM_NAME . '=' .
				 self::OUTPUT_TYPE_IFRAME;
			
			$request_path_depth = count(explode('/', $_SERVER['REQUEST_URI']));
			$script_path_depth = count(explode('/', $_SERVER['SCRIPT_NAME']));
			$rwb_path_relative_to_request_path = str_repeat('../', 
				$request_path_depth - $script_path_depth) . 'rwb';
			
			require 'substitute-page.php';
			exit();
		}
		
		if (self::getOutputType() == self::OUTPUT_TYPE_JSONP) {
			
			// Output header now since other header output might block it later.
			header('Content-Type: application/javascript');
		}
		
		// Turn on output buffer to capture all output.
		ob_start();
		
		// Make this run after all output is completed.
		register_shutdown_function(
			function ()
			{
				
				$html = ob_get_clean();
				
				// Insert base tag, unless there already is one.
				if (stripos($html, '<base') === false) {
					
					// Varieties of head tag. Some sites use the second version...
					$head_tags = array(
						'<head>',
						'<head >'
					);
					
					foreach ($head_tags as $head_tag) {
						$html = str_replace($head_tag, 
							$head_tag . '<base href="' .
								 RedirectWhenBlockedFull::getBaseUrl() .
								 self::$base_url_suffix . '" target="' . self::TOP_WINDOW_NAME . '">', 
								$html, $count);
						if($count > 0) {
							break;
						}
					}
				}
				
				/*
				 * This request comes from another base url (mirror or source host).
				 * We take the normal output and turn it into a jsonp response.
				 */
				if (RedirectWhenBlockedFull::getOutputType() ==
					 RedirectWhenBlockedFull::OUTPUT_TYPE_JSONP) {
					
					print 
						$_GET['callback'] . '(' . json_encode(
							array(
								'html' => utf8_encode_current_charset($html)
							)) . ');';
				} 

				else {
					print $html;
				}
			});
	}

	public static function setBaseUrlSuffix($base_url_suffix)
	{
		self::$base_url_suffix = $base_url_suffix;
	}

	public static function setUrls($alt_base_urls, $alt_url_collections)
	{
		self::$alt_base_urls = $alt_base_urls;
		self::$alt_url_collections = $alt_url_collections;
	}

	public static function setUrlsFromConfDir()
	{
		$alt_base_urls = file(__DIR__ . '/conf/alt_base_urls.txt', 
			FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$alt_url_collections = file(__DIR__ . '/conf/alt_url_collections.txt', 
			FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		self::setUrls($alt_base_urls, $alt_url_collections);
	}

	public static function setWebsiteTitle($website_title)
	{
		self::$website_title = $website_title;
	}
	
	// Helper function which doesn't obviously belong in this class, but is
	// very useful.
	public static function startsWith($str, $needle)
	{
		if (is_array($needle)) {
			foreach ($needle as $n) {
				if (startsWith($str, $n)) {
					return true;
				}
			}
			return false;
		}
		
		if (strlen($needle) > strlen($str)) {
			return false;
		}
		
		return strcasecmp(substr($str, 0, strlen($needle)), $needle) === 0;
	}
}