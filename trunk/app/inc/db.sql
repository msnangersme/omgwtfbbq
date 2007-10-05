
--
-- Table structure for table feed
--

CREATE TABLE feed (
  id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  feedurl varchar(255) NOT NULL default '',
  siteurl varchar(255) default NULL,
  iconurl varchar(255) default NULL,
  description varchar(255) default NULL,
  created datetime default NULL,
  lastupdate datetime default NULL,
  position int(11) NOT NULL default '0',
  private int(11) NOT NULL default '1',
  active int(11) NOT NULL default '1',
  folderid int(11) NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY url (feedurl)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table folder
--

CREATE TABLE folder (
  id int(11) NOT NULL auto_increment,
  name varchar(255) NOT NULL default '',
  position int(11) NOT NULL default '0',
  PRIMARY KEY  (id),
  UNIQUE KEY name (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table item
--

CREATE TABLE item (
  id int(11) NOT NULL auto_increment,
  feedid int(11) NOT NULL default '0',
  hash varchar(40) default NULL,
  guid text,
  linkurl varchar(255) default NULL,
  enclosureurl varchar(255) default NULL,
  title varchar(255) default NULL,
  content text,
  unread int(11) default '1',
  author varchar(255) default NULL,
  created datetime NOT NULL default '0000-00-00 00:00:00',
  pubdate datetime default NULL,
  PRIMARY KEY  (id),
  KEY url (linkurl),
  KEY guid (guid(10)),
  KEY feedid (feedid),
  KEY feedguid (feedid,guid(40)),
  FULLTEXT KEY ft_index (title,content)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



/*

import from gregarious

insert into feed select id, title, url, siteurl, icon, descr, dateadded, daterefreshed, position, 1, 1, parent from rss.channels;

insert into folder select id, name, position from rss.folders;

*/
