RedirectWhenBlocked
=====================

## Goals

Thousands of websites are blocked in China. One approach to tackle this is to create mirror websites. The main problem of mirror websites is finding them. This project remedies that problem partially by automatically redirecting users to a mirror website if the original website cannot be accessed (presumably because it has been blocked). Additionally if the mirror website itself is blocked, it can in turn redirect to another mirror website. This works if:

1. The user has visited the website succesfully in the past at least once.
2. The user is using a compatible web browser (see below).

## Inspiration

This project owes its existence entirely to https://github.com/willscott/activist/. We have copied the approach to utilize the HTM5L Application Cache to rescue users who cannot access the website. This project is different from activist.js in the following ways:

1. It does not cache the website itself. We are using the application cache to address censorship, and we don't assume that the website itself should be cached. Caching the website itself involves issues like having to manually reload resources when content has been updated. We want the impact on the website to be minimal.
2. We are focusing on redirecting users to alternative URLs when the original URL has been blocked, not keeping the original alive.
3. We are creating this specifically to combat the Great Firewall of China, though this approach could also be used to tackle web filtering elsewhere.

## How to test that it works

1. Implement this project on a website (or use one of the demo URLs below).
2. Load the website in a browser.
3. Alter your connection so that you cannot access the website anymore. For example, you can modify your hosts file to point the hostname at a non-responsive IP address (simulating DNS poisoning). Or if the hostname is actually blocked by the GFW, just access the website from inside the GFW.
4. After some delay, your browser should redirect you to the backup URL that you configured.

## Browser compatibility

* Google Chrome: OK.
* Firefox: Application cache works, but the fallback is apparently not always triggered if a website is DNS poisoned, or it's very slow.
* Other browsers: Application cache should work in IE 10+, Safari 4+ etc (https://developer.mozilla.org/en-US/docs/Web/HTML/Using_the_application_cache#Browser_compatibility) but we have not yet tested this.

## Online demos

* http://rwb.greatfire.org/demo/
* https://boxun1.azurewebsites.net/ (actually DNS poisoned in China)

We are also implementing this on our mirror sites, listed on https://github.com/greatfire/wiki.

## How to build

If you are using Linux you can build the demo directory by running ./build_demo.sh. If you cannot run this script, all you have to do is replace the parameters in the src files. Currently the only parameter is {RWB_REDIRECTION_URL}. Just replace this parameter with the URL that you want to redirect users to if they can't access your website.

## How to implement on a live website

1. Build and test the demo using your parameters.
2. Copy all files except index.html from the demo directory to your website directory.
3. Add this code to the HTML of your website (copied from index.html in the demo directory):

```
<iframe src="rwb.iframe.html" style="height: 0; visibility: hidden; width: 0"></iframe>
```

You don't have to add the code to every HTML file, but the cache will only work if the user has viewed a page containing this code.

## If you need a mirror website

We build and operate mirror websites that are difficult to block using an approach called Collateral Freedom. For more information see https://unblock.cn.com or contact greatfire@greatfire.org.

## Contributions

Code contributions and feedback are very welcome.
