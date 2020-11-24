=== Responsive iframe ===
Contributors: PatrickPelayo
Tags: star wars, search star, star, wars, darth vader
Requires at least: 5.5.3
Tested up to: ^5.5.3
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Search Star Wars Stuff

== Description ==
Widget that lets you search characters,vehicles,planets, and etc. for Star Wars.

= Instructions =
Install the plugin, it may take about a minute to populate the tables in the database. 
This only needs to be done once unless the plugin is deleted. Deleting the plugin will remove the created tables from the database.

= Technical Stuff for Developers =
> This section provides a technical overview of the plugin.

The plugin was created thru the use of  [Create-Guten-Block](https://github.com/ahmadawais/create-guten-block) package that can be obtained thru NPM.

The source files can be found in the src folder.
* responsiveIframe.js is the file that makes the iframes responsive from the post page.


* constants.js hold the constants that are plugin wide.


* block.js registers the block and handles the edit and save functions. 
Any iframe responsiveness in the block editor is handled by the block.js.


* inspector.js solely defines the inspector sidebar, this is used within block.js.

== Screenshots ==
1. Example of New York Times in an iframe.
2. The iframe in the website, demonstrating from a mobile viewpoint.
3. The iframe in the website, demonstrating from a desktop viewpoint.

== Changelog ==

= 1.0 =
* first release
	
== Upgrade Notice ==

= 1.0 =
* first release
	
== Frequently Asked Questions ==

 = In the editor I can't click on the iframe =
 
 Click directly underneath the iframe element, you want to select the block so you can edit it. 
 
 = What can I stylize without breaking the iframe =
 
 Leave the iframe element largly alone, focus css on the parent div element. 
 Do not modify the height on the div element.