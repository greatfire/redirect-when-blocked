<!DOCTYPE html>
<html manifest="<?php print $rwb_path_relative_to_request_path ?>/rwb.appcache">
<head>
<meta charset="UTF-8">
<title><?php print self::$website_title ?></title>
<style>
<?php require 'substitute-page.css' ?>
</style>
</head>
<body>
	<div>
		<p>Loading...</p>
		<h1><?php print self::$website_title ?></h1>
		<p>If the website fails to load, you may be able to find another
			mirror URL here:</p>
	<?php if(self::$alt_url_collections) { ?>
	<ul>
		<?php foreach(self::$alt_url_collections as $alt_url_collection) { ?>
		<li><a href="<?php print $alt_url_collection; ?>"><?php print $alt_url_collection; ?></a></li>
		<?php } ?>
	</ul>
	<?php } ?>
	</div>
	<iframe frameBorder="0" scrolling="no" verticalscrolling="no"
		seamless="seamless" height="600px" src="<?php print $iframe_src ?>"></iframe>
	<script src="<?php print $rwb_path_relative_to_request_path ?>/jquery-1.11.1.min.js"></script>
	<script>
	var alt_base_urls = <?php print json_encode(self::$alt_base_urls) ?>;
	var get_param_name = '<?php print self::GET_PARAM_NAME ?>';
	var output_type_jsonp = '<?php print self::OUTPUT_TYPE_JSONP ?>';
	<?php require 'substitute-page.js' ?>
	</script>
</body>
</html>