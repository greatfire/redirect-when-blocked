<?php

class RedirectWhenBlockedFull
{

	public function __construct($alt_url_bases, $website_title, 
		$alt_url_collections, $get_param_name = 'rwb3498472')
	{
		/*
		 * Normal request. Substitute the response with our own page.
		 */
		if (! isset($_GET[$get_param_name])) {
			
			$iframe_src = $_SERVER['REQUEST_URI'];
			if ($_SERVER['QUERY_STRING']) {
				$iframe_src .= '&';
			} else {
				$iframe_src .= '?';
			}
			
			$iframe_src .= $get_param_name . '=1';
			
			require 'substitute-page.php';
			exit();
		}		

		/*
		 * This request comes from another url_base (mirror or source host).
		 * We take the normal output and turn it into a jsonp response.
		 */
		elseif ($_GET[$get_param_name] == 'jsonp') {
			
			// Turn on output buffer to capture all output.
			ob_start();
			
			// Make this run after all output is completed.
			register_shutdown_function(
				function ()
				{
					// Capture all output from the buffer and turn it into jsonp.
					header('Content-Type: application/javascript');
					$html = ob_get_clean();
					print 
						$_GET['callback'] . '(' . json_encode(
							array(
								'html' => $html
							)) . ');';
				});
		}
		
		/*
		 * Else, do nothing. This request is from the iframe in the substitute page.
		 */
	}
}