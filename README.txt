=== Plugin Name ===
Contributors: Zoefff, Ugoku
Donate link: https://www.werkaandemuur.nl/
Tags: wadm, art, werk aan de muur, oh my prints
Requires at least: 4.9
Requires PHP: 5.4.0
Tested up to: 5.4
Stable tag: 1.1.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrate your "Werk aan de Muur" shop into your own Wordpress site.

== Description ==

"Werk aan de Muur" is an online marketplace for print on demand wall art. Artists and photographers can upload their images, set their commissions, and instantly sell custom art prints to customers from across Europe.

With this plugin, you can easily integrate your "Werk aan de Muur" shop into your own Wordpress site. After installation, there are two tags you can use to add a list of artworks to a page or post.

= All artworks =

[wadm_artlist]

This tag prints a paginated list of your artworks. The output can be customized with a few attributes:

* `limit`: Number of artworks per page. Default is 12 artworks. Max. 33 artworks per page.
* `columns`: Specifiy the number of columns. Defaults to 3 columns.
* `order`: Set the artwork order. Defaults to order as in shop. Accepted values are `date_asc`, `date_desc`, `title_asc`, `title_desc` and `rating`

For example, show 20 artworks in 2 columns, ordered by date (descending, newest first) with this tag:

[wadm_artlist limit=20 columns=2 order=date_desc]

= Specific album =

[wadm_album albumid=999]

The album tag allows you to print artworks from a specific album. You can find the album id in your artist dashboard. The output can again be customized with the `limit`, `columns` and `order` attributes. The `albumid` attribute is required. For example:

[wadm_album albumid=999 limit=20 columns=2]

= Single artwork =

[wadm_artwork artid=999]

Prints a specific artwork. Use the 'werkcode' as artid.

== Installation ==

Installation of this plugin is simple:

1. Extract the plugin into your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Open the plugin settings page and enter your User ID and API key
1. Use one of the short tags (more info @ FAQ) to display a list of artworks

== Frequently Asked Questions ==

= Usage =

See the 'Description' section for some examples how to use this plugin.

= I don't see my changes at Werk aan de Muur on my Wordpress site! =

Due to caching there can be a delay of approximately 2 hours before you see any changes like title or price updates appear on your Wordpress site. This is intended behaviour, sometimes some patience is required!

= The plugin doesn't work! =

There's a short list of things you can check if the plugin doesn't work.

* Is the plugin activated?
* Did you supply the correct Artist ID and API key?
* Does the page or post you're testing contain a shortcode? The simple code `[wadm_artlist]` should always show a list of artworks.

Still don't get the expected result? Then there are a few more technical things to check.

* Your site should be able to connect to the outside world. Check (with your hosting provider) if the 'fopen wrappers' are enabled, and that you're allowed to use 'file_get_contents()'.
* The plugin connects on an HTTPS url. Make sure your server has the appropriate (OpenSSL) libraries enabled, and is able to make an SSL connection.

= Do you have any questions or requests? =

Please contact us at info@werkaandemuur.nl with any questions or suggestions. We'll continually add them to this FAQ!

== Screenshots ==

1. Example screenshot of an artlist.

== Changelog ==

= 1.1.12 =
* Bugfix, feed abstract cannot really be abstract because it's used for connection testing

= 1.1.11 =
* Implement more aggressive caching; cache errors too (but retry within 10 minutes)
* Prefer cURL over file_get_contents

= 1.1.10 =
* Tweaks to ease debugging in case of a problem

= 1.1.9 =
* Allow sorting artlists and albums by rating

= 1.1.8 =
* Fix PHP notice

= 1.1.7 =
* Fix another PHP Warning

= 1.1.6 =
* Made getHtml compatible with abstract method to prevent an PHP Warning
* Styling tweak to inherit line-height
* Added code which can replace file_get_contents calls with a CURL call. Commented code in feed-abstract, if you know what you're doing, you're welcome to use it.
* Introduced a 'tools' directory with script to debug API connection issues

= 1.1.5 =
* Use HTTPS image url when ssl is enabled

= 1.1.4 =
* Reset some widths to prevent theme styling from overriding wadm plugin styling

= 1.1.3 =
* Display artist name in listing when available

= 1.1.2 =
* Use correct link and title for single artworks

= 1.1.1 =
* Added some plugin configuration and connection tests

= 1.1 =
* Don't print empty navigation containers
* Basic validation of admin settings input
* New tag [wadm_artwork] to fetch a single artwork
* Increase max per page limit to allow for 3x11 artworks

= 1.0.2 =
* Tweaked some styling rules to counter-effect specific theme styling

= 1.0.1 =
* Added support for custom artwork order (by title or date)

= 1.0 =
* First release
