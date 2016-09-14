__________

Setting up the webAppDemo:
1. Unzip & upload files to your zone. Or copy into a new directory in your localhost environment (if using MAMP/LAMP/WAMP/XAMP...)
2. Set up your Twitter API credentials & copy the relevant fields into the getTweet function in flicktwitter.php (follow this tutorial at http://www.webdevdoor.com/php/authenticating-twitter-feed-timeline-oauth/)
3. Set up your Flickr API credentials & copy the relevant fields into the getImage function in index.html (here https://www.flickr.com/services/apps/create/)
4. Go to your zone/localhost's phpMyAdmin. Create a database called webappdemo. Import the combos.sql file to populate that database. (Click on the database, go to Import tab).
5. Create a user for your database - Privileges tab - set a username, password & allow DATA only permissions (SELECT, INSERT, UPDATE, DELETE)
6. Go to flicktwitter.php & enter the database credentials there.
7. Visit your web application in a browser.

Check the JavaScript error console & the PHP error logs if things don't work.