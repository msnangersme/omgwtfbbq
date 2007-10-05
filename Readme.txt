

OMGWTFBBQ News Reader

Originally Published by Russell Beattie, http://www.russellbeattie.com

Thanks to the hard work of the guys at Simplepie.org. 

Thanks to Mike Rowehl (http://rowehl.com) for testing it out and giving me the name, and Diego Doval (http://diegodoval.com) for his input. 

-----------------------------------------------


Setup for the OMGWTFBBQ news reader.

1) Create a new MySQL database, preferably named 'myfeeds'. 

2) Use the ./inc/db.sql to create the feed, item and folder tables in your new db

3) Copy the ./inc/config_sample.php to config.php

4) Edit the config.php to include the proper database params

5) Use an .htaccess file and mod_rewrite to do something like the following, which will secure the site and route everything through index.php:

	AuthType Basic                                                                                            
	AuthName "Password Required"
	AuthUserFile /opt/passwords
	Require valid-user


	RewriteEngine On
	RewriteBase /myfeeds/

	RewriteCond $1 !^(index\.php|favicon\.ico|images/.+|media/.+|style\.css)
	RewriteRule ^(.*)$ index.php [L]



Once you've tested the site and have added a few feeds, you can test the update.php PHP CLI script via the command line (it'll look like this:)

	$ php update.php
	Checking: 1 - http://www.engadgetmobile.com/rss.xml
	Checking: 2 - http://blogs.s60.com/posts.xml
	Checking: 9 - http://www.textually.org/picturephoning/index.rdf
	Checking: 10 - http://feeds.feedburner.com/mobileburn/rss2
		    Error: cURL error 28: Operation timed out after 10 seconds with 0 bytes received
	Checking: 11 - http://www.dailywireless.org/feed/atom/
	Checking: 12 - http://www.cellular-news.com/rss/news.xml
	Checking: 36 - http://www.techmeme.com/index.xml
		    New Item found: http://www.techmeme.com/070917/p107#a070917p107
	...


Once you've tested the update, add it to your crontab. 

*Change the directory to where you've installed the php pages*.

0,15,30,45 * * * *  root    cd /opt/htdocs/myfeeds/ ; php -f update.php 


-Russ





All the code in OMGWTFBBQ except for where it is written otherwise in the code is under the MIT license:

-----------------------------------------------


The MIT License

Copyright (c) <year> <copyright holders>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

