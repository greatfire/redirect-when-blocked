function iframeLoaded($iframe) {
	console.log('loaded');
	document.title = $iframe.contents().find('title').text();
	$('div').html($('div p:nth(1)').text() + $('div li').map(function() { return $(this).html() }).get().join(', '));
	$('div').addClass('top');
	
	if($iframe.contents().find('head base').length == 0) {
		$iframe.contents().find('head').prepend($('<head>'));
	}
	$iframe.contents().find('head base').attr('target', window.name);

	setIframeHeight($iframe);
	setInterval(function() {
		setIframeHeight($iframe);
	}, 1000);
}

function setIframeHeight($iframe) {
	var targetHeight = $(window).height();
	if($iframe[0].contentWindow.window.document.body != null) {
		targetHeight = Math.max(
				targetHeight,
				$iframe[0].contentWindow.window.document.body.scrollHeight
		);
	}

	var actualHeight = $iframe.height()
	+ parseInt($iframe.contents().find('body').css('margin-top'))
	+ parseInt($iframe.contents().find('body').css('padding-top'))
	+ parseInt($iframe.contents().find('body').css('padding-bottom'))
	+ parseInt($iframe.contents().find('body').css('margin-bottom'));

	if(targetHeight > actualHeight || targetHeight < (actualHeight - 100)) {
		$iframe.height(targetHeight + 10);
	}
}

if (!window.console) {
	console = {	log : function() {}	};
}

if (typeof String.prototype.startsWith != 'function') {
	String.prototype.startsWith = function (str){
		return this.lastIndexOf(str, 0) === 0;
	};
}

var base_url = "";
var relative_url = "";
for(var i in alt_base_urls) {
	if(window.location.href.startsWith(alt_base_urls[i])) {
		base_url = alt_base_urls[i];
		relative_url = window.location.href.substring(alt_base_urls[i].length);
		break;
	}
}

$('iframe').height($(window).height());

var ifrInt = setInterval(function() {
	if($('iframe').contents().find('body *:first').length > 0) {
		iframeLoaded($('iframe'));
		clearInterval(ifrInt);
	}
}, 300);

var done = false;

setTimeout(function() {
	if(!done) {
		console.log('emergency!');
		$('li a').each(function() {
			window.location = $(this).attr('href');
		});
	}
}, 20000);

for(var i in alt_base_urls) {
	(function(alt_base_url) {
		if(window.location.href.startsWith(alt_base_url)) {
			return;
		}

		var alt_url = alt_base_url + relative_url;

		var alt_url_parser = document.createElement('a');
		alt_url_parser.href = alt_url;
		if(alt_url_parser.search) {
			alt_url += '&';
		} else {
			alt_url += '?';
		}
		alt_url += get_param_name + '=' + output_type_jsonp + encodeURIComponent(alt_base_url);

		$.ajax({
			dataType: 'jsonp',
			url: alt_url,
			cache: true,
			jsonpCallback: 'jsonpCallback' + i
		}).success(function(data) {
			if(!done && typeof data.html !== 'undefined') {
				done = true;
				console.log(alt_url + ' succeeded');
				$iframe = $('iframe').clone();
				$('iframe').remove();
				$iframe.attr('src', '');
				$('body').append($iframe);

				var iframeDoc = $iframe[0].contentDocument || $iframe[0].contentWindow.document;
				iframeDoc.open();
				iframeDoc.write(data.html);
				iframeDoc.close();
			}
		});
	})(alt_base_urls[i]);
}