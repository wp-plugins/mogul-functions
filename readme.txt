=== Plugin Name ===
Contributors: brenfm
Donate link: http://example.com/
Tags: themes, function
Requires at least: 3.0.1
Tested up to: 3.1.0
Stable tag: 0.1

This plugin is intended for use by theme developers to shortcut longer coding.

== Description ==

This plugin is a collection of handy functions that we've built and use on most of our WordPress sites.  They are intended for use by WordPress theme developers.  We've published them under the GPL to allow others to use them and to get feedback on any possible improvements.

This includes

*   mog_get_outside_id() - to quickly find the ID number for the current page (solves internal loop issues)
*   mog_quik_title() - provides a quick way to return a link with the permalink for a post/page and it's title
*   mog_in_hierarchy() - checks to see if a page is in a given hierarchy to enable inclusion of content for a given page anscestor/descendants tree
*   mog_simple_sidebar() - outputs a list of pages using wp_list_pages(). Traverses to top level parent and outputs a list of it's children. (for sidebars)

== Installation ==


1. Unzip all files to the `/wp-content/plugins/mogul-functions` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place any of the functions in your templates in accordance with usage pages.

== Frequently Asked Questions ==

= Where can I find out more information? =

The plugin is documented here: http://plugins.mogul.co.nz/about/mogul-functions/

== Screenshots ==

As this is for functions in a theme, there are no screenshots

== Changelog ==

= 0.1 =
* Released into the wild