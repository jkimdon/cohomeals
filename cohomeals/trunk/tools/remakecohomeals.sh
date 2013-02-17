#!/bin/bash

set -x

########## 

sudo mysqladmin -f drop cohomeals
sudo mysqladmin create cohomeals
sudo mysql cohomeals < testmeals-privileges.sql
#sudo mysql cohomeals < tables-mysql.sql
sudo mysql cohomeals < ~/newStuff/coho/meals/backups/backup.sql
