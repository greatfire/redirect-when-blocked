RedirectWhenBlocked
=====================

Thousands of websites are blocked in China. One approach to tackle this is to create mirror websites. The main problem of mirror websites is finding them. This project remedies that problem partially by automatically redirecting users to a mirror website if the original website cannot be accessed (presumably because it has been blocked). Additionally if the mirror website itself is blocked, it can in turn redirect to another mirror website. This works if:

1. The user has visited the website succesfully in the past at least once.
2. The user is using a compatible web browser (see below).

## Two editions

Basic Edition: https://github.com/greatfire/redirect-when-blocked/tree/master/basic
Full Edition: https://github.com/greatfire/redirect-when-blocked/tree/master/full

                                    | Basic Edition         | Full Edition
----------------------------------  | --------------------- | ------------
Server requirements                 | None                  | PHP
Accessibility and SEO implications  | None                  | Major
Speed                               | Slow / unpredictable  | Fast

## Inspiration

This project owes its existence entirely to https://github.com/willscott/activist/. We have copied the approach to utilize the HTM5L Application Cache to rescue users who cannot access the website. This project is different from activist.js in the following ways:

1. It does not cache the website itself. We are using the application cache to address censorship, and we don't assume that the website itself should be cached. Caching the website itself involves issues like having to manually reload resources when content has been updated. We want the impact on the website to be minimal.
2. We are focusing on redirecting users to alternative URLs when the original URL has been blocked, not keeping the original alive.
3. We are creating this specifically to combat the Great Firewall of China, though this approach could also be used to tackle web filtering elsewhere.

## How to test that it works

1. Implement this project on a website (or use one of the demo URLs).
2. Load the website in a browser.
3. Alter your connection so that you cannot access the website anymore. For example, you can modify your hosts file to point the hostname at a non-responsive IP address (simulating DNS poisoning). Or if the hostname is actually blocked by the GFW, just access the website from inside the GFW.
4. After some delay, your browser should redirect you to the backup URL that you configured.

## If you need a mirror website

We build and operate mirror websites that are difficult to block using an approach called Collateral Freedom. For more information see https://unblock.cn.com or contact greatfire@greatfire.org.

## Contributions

Code contributions and feedback are very welcome.
