#!/bin/sh

TOOLS=$(cd `dirname $0` && pwd)
set -e
set -x

cd ~/
rm -rf coho-mirror
svn export http://cohomeals.googlecode.com/svn/cohomeals/trunk coho-mirror
#svn export file:///var/svn/coho/cohomeals/trunk coho-mirror
cd coho-mirror
for f in `cat $TOOLS/mirror.exclude`; do
  rm -rf $f
done

# include the reminder script, even though it is contained within the tools/
# directory, excluded in mirror.exclude above.
mkdir -p tools
svn export http://cohomeals.googlecode.com/svn/cohomeals/trunk/tools/weekly_reminder.php tools/weekly_reminder.php
#svn export file:///var/svn/coho/cohomeals/trunk/tools/weekly_reminder.php \
#       tools/weekly_reminder.php

lftp -f $TOOLS/mirror.lftp

