=== Plugin Name ===
Contributors: BrenFM, MogulNZ
Donate link: http://plugins.mogul.co.nz/about/mogul-functions/
Tags: themes, functions, sidebar, parent
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 1.1.5

This plugin is intended for use by theme developers to hasten coding and to save the world from tyranny. But mostly the theme dev bit.

== Description ==

*   Sick of reusing code over and over again in your WordPress sites?
*   Bored of searching for methods to quickly build your WordPress themes?
*   Wish there was a better way?

Well now there is!

We'd like to introduce you to Mogul Custom Functions.  Built with WordPress theme devs in mind, but simple enough for anyone to use!

Never before has a set of functions been made available to the WordPress theme dev community that rivals Mogul Custom Functions (now with a real donation link for Beer money!)

Okay all silliness aside, this plugin is a collection of handy functions that we've built and use on almost all of our WordPress sites.  They are intended for use by WordPress theme developers and provide quick methods of displaying post/page info in your WP themes.  We've published them under the GPL to allow others to use them and to allow you to give us feedback on how awesome they are.

If you find this functionset even remotely useful, please follow the donate links so we can afford beer!

This includes

*   mog_get_outside_id() - to quickly find the ID number for the current page (solves internal loop issues)
*   mog_quik_title() - provides a quick way to return a link with the permalink for a post/page and it's title
*   mog_in_hierarchy() - checks to see if a page is in a given hierarchy to enable inclusion of content for a given page anscestor/descendants tree
*   mog_simple_sidebar() - outputs a list of pages using wp_list_pages(). Traverses to top level parent and outputs a list of it's children. (for sidebars)
*   a widget for mog_simple_sidebar() output

== Installation ==


1. Unzip all files to the `/wp-content/plugins/mogul-functions` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place any of the functions in your templates in accordance with usage pages.

== Frequently Asked Questions ==

= Where can I find out more information? =

The plugin is documented here: http://plugins.mogul.co.nz/about/mogul-functions/

= What's your fascination with beer? =

While you eat your breakfast of bacon and eggs, a sober developer waits.

After caffeine, beer is the most important substance in the life cycle of a PHP developer.

While you drive your fancy super economical hybrid vehicle to work for an environmentally friendly green company, a sober developer waits.

Please give generously.

== Screenshots ==

As this is for functions in a theme, there are no screenshots

== Changelog ==
= 1.1.4 =
* Added to mog_long_excerpt() to strip out shortcode tags

= 1.1.3 =
* Meta update only - no significant change to functions.

= 1.1.2 =
* added backwards compatability for spelling error in hierarchy function

= 1.1.1 =
* Simple Sidebar function gets wrapped into a WordPress widget.

= 1.1 =
* Released into the wild