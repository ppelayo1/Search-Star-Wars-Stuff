=== Search Star Wars Stuff ===
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

Then add the widget to your site's widget sidebar location as you would any other widget. This can be done from the main page by moving your mouse over apperance
and then clicking either Customize, or widgets.

Under customize select Widgets from the left sidebar and add "Search Star Wars" to your choosen widget location.
Under widgets select the widget location, and then add "Search Star Wars" to that choosen widget location.

= Technical Stuff for Developers =
> This section provides a technical overview of the plugin.

The main files are located in the SRC folder.
PHP files "classes.php" and "backend.php" both handle the creation of the tables and removal of tables from the database.
The tables are populated with star wars data obtained from https://swapi.dev/

"widget.php" defines the widget for wordpress, and "ajax.php" works with the "widget.js" in requests for data from the database.

For JS the "widget.js" handles the ajax calls to the database by sending the requests to "ajax.php".
"widget.js" once it recieves data builds auto complete hints, and builds the display when a record of data is recieved.

CSS files "jqueryAutoComplete.css" of which was taken from https://jqueryui.com/themeroller/
I took the classes needed for the basic auto complete feature.
"widget.css" styles the widget and the modifies the auto-complete classes as necessary

== Screenshots ==


== Changelog ==

= 1.0 =
* first release
	
== Upgrade Notice ==

= 1.0 =
* first release
	
== Frequently Asked Questions ==


 
 