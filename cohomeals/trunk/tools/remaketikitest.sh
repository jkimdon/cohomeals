#!/bin/bash

set -x

########## 

sudo mysqladmin -f drop tikitest
sudo mysqladmin create tikitest
sudo mysql tikitest < tikitest-privileges.sql
sudo mysql tikitest < ~/newStuff/coho/meals/backups/backup_tikidata.sql
sudo mysql tikitest < tikitest-mungeformoo.sql