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

# include the reminder scripts, even though they are contained within the tools/
# directory, excluded in mirror.exclude above.
mkdir -p tools
svn export http://cohomeals.googlecode.com/svn/cohomeals/trunk/tools/weekly_reminder.php tools/weekly_reminder.php
svn export http://cohomeals.googlecode.com/svn/cohomeals/trunk/tools/crew_reminders.php tools/crew_reminders.php

lftp -f $TOOLS/mirror.lftp

