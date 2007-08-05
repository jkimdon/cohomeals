#!/bin/bash

set -x

realdatabase=`sed -n 's/^db_database: \(.*\)/\1/p' includes/settings.php`
sed -i 's/^\(db_database:\).*/\1 testmeals/' includes/settings.php


sudo mysqladmin -f drop testmeals
sudo mysqladmin create testmeals
sudo mysql testmeals < tools/testmeals-privileges.sql
sudo mysql testmeals < tables-mysql.sql






sed -i "s/^\(db_database:\).*/\1 $realdatabase/" includes/settings.php