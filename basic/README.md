RedirectWhenBlocked Basic Edition
===================================

## Online demo

* https://d3059gkikm7ixv.cloudfront.net/basic/demo/

We are also implementing this on our mirror sites, listed on https://github.com/greatfire/wiki.

## How to build

If you are using Linux you can build the demo directory by running ./build_demo.sh. If you cannot run this script, all you have to do is replace the parameters in the src files. Each parameter is formatted like {PARAMETER}. The following parameters exist:

* RWB_REDIRECTION_URLS: Alternative URLs to redirect the user to if the website fails.
* RWB_EMAIL: Contact email shown on the fallback page.
* RWB_JQUERY_URL: URL to jQuery library. Change this if you use a different jQuery version or if the file is hosted elsewhere.
* RWB_TITLE: Title shown on the fallback page.
* RWB_FALLBACK_INTRO, RWB_FALLBACK_THIS_URL, RWB_FALLBACK_EMAIL, RWB_FALLBACK_REDIRECTING: Used for localization. Translate these if you want to use a language other than English.

## How to implement on a live website

1. Build and test the demo using your parameters.
2. Copy all files except index.html from the demo directory to your website directory.
3. Add this code to the HTML of your website (copied from index.html in the demo directory):

```
<iframe src="rwb.iframe.html" style="height: 0; visibility: hidden; width: 0"></iframe>
```

You don't have to add the code to every HTML file, but the cache will only work if the user has viewed a page containing this code.
