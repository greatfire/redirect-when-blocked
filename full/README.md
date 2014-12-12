RedirectWhenBlocked Basic Edition
===================================

## Online demo

* https://d3059gkikm7ixv.cloudfront.net/full/demo/

## How to implement on a live website

1. Copy the "rwb" directory from the demo to your website directory.
2. Edit the redirection URLs in the "rwb/conf" directory.
3. Add this code to your website:

```
require 'rwb/RedirectWhenBlockedFull.inc';
RedirectWhenBlockedFull::setUrlsFromConfDir();
RedirectWhenBlockedFull::setWebsiteTitle(WEBSITE_TITLE);
RedirectWhenBlockedFull::run();
```

The code has to be included before any output is sent to the browser.

WEBSITE_TITLE is shown on the cached page before the content is loaded.