<!DOCTYPE html>
<html manifest="rwb/rwb.appcache">
<head>
<meta charset="UTF-8">
<title><?php print $website_title ?></title>
<style>
html, body {
	margin: 0;
	padding: 0;
}

p {
	text-align: center;
}

h1 {
	color: #aaa;
	text-align: center;
}

iframe {
	border: 0;
	margin: 0;
	padding: 0;
	width: 100%;
}
</style>
</head>
<body>
	<p>Loading...</p>
	<h1><?php print $website_title ?></h1>
	<iframe src="<?php print $iframe_src ?>"></iframe>
	<script src="rwb/jquery-1.11.1.min.js"></script>
	<script>
	function iframeLoaded($iframe) {
		document.title = $iframe.contents().find('title').text();
		$('p,h1').remove();
		
		$iframe.attr('frameBorder', '0');
		$iframe.attr('scrolling', 'no');
		$iframe.attr('seamless', 'seamless');

		setIframeHeight($iframe);
		setInterval(function() {
			setIframeHeight($iframe);
		}, 1000);
		
		var base = '<base target="_parent">';
		$iframe.contents().find('head').append(base);
	}

	function setIframeHeight($iframe) {
		var targetHeight = Math.max(
				$iframe[0].contentWindow.window.document.body.scrollHeight,
				$(window).height()
		);
		
		var actualHeight = $iframe.height()
		+ parseInt($iframe.contents().find('body').css('margin-top'))
		+ parseInt($iframe.contents().find('body').css('padding-top'))
		+ parseInt($iframe.contents().find('body').css('padding-bottom'))
		+ parseInt($iframe.contents().find('body').css('margin-bottom'));
		
		if(targetHeight > actualHeight || targetHeight < (actualHeight - 100)) {
			$iframe.height(targetHeight + 10);
		}
	}

	if (typeof String.prototype.startsWith != 'function') {
		String.prototype.startsWith = function (str){
			return this.lastIndexOf(str, 0) === 0;
		};
	}
	
	var done = false;
	$('iframe').load(function() {
		try {
			if($(this).contents().length > 0) {
				done = true;
				iframeLoaded($(this));
				return;
			}
		} catch (e) {
		}
		$(this).remove();
	});

	var alt_url_bases = <?php print json_encode($alt_url_bases) ?>;
	var relative_url;
	for(var i in alt_url_bases) {
		if(window.location.href.startsWith(alt_url_bases[i])) {
			relative_url = window.location.href.substring(alt_url_bases[i].length);
			break;
		}
	}
	for(var i in alt_url_bases) {
		(function(alt_url_base) {
			if(window.location.href.startsWith(alt_url_base)) {
				return;
			}

			var alt_url = alt_url_base + relative_url;
			
			var alt_url_parser = document.createElement('a');
			alt_url_parser.href = alt_url;
			if(alt_url_parser.search) {
				alt_url += '&';
			} else {
				alt_url += '?';
			}
			alt_url += '<?php print $get_param_name ?>=jsonp';
			
			$.ajax({
				dataType: 'jsonp',
				url: alt_url
			}).success(function(data) {
				if(!done) {
					done = true;
					console.log(alt_url + ' succeeded');
					$('iframe').remove();
					$iframe = $('<iframe>');
					$('body').append($iframe);

					data.html = data.html.replace('</head>', '<base href="' + alt_url_base + '"></head>');
	
					var iframeDoc = $iframe[0].contentDocument || $iframe[0].contentWindow.document;
					iframeDoc.open();
					iframeDoc.write(data.html);
					iframeDoc.close();
	
					iframeLoaded($iframe);
				}
			});
		})(alt_url_bases[i]);
	}
</script>
</body>
</html>