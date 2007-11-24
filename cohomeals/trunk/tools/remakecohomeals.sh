#!/bin/bash

set -x

########## 

sudo mysqladmin -f drop cohomeals
sudo mysqladmin create cohomeals
sudo mysql cohomeals < tools/testmeals-privileges.sql
sudo mysql cohomeals < tables-mysql.sql
sudo mysql cohomeals < ~/coho/meals/data/backups/backup.sql
