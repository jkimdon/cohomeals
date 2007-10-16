#!/bin/sh

TOOLS=$(cd `dirname $0` && pwd)
set -e
set -x

cd ~/
rm -rf coho-mirror
svn export file:///var/svn/coho/cohomeals/trunk coho-mirror
cd coho-mirror
for f in `cat $TOOLS/mirror.exclude`; do
  rm -rf $f
done
lftp -f $TOOLS/mirror.lftp

