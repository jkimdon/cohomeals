#!/bin/sh
# backup.sh : script to backup coho tiki files before upgrades (includes file gallery and site customizations)
# doesn't back up the database

TOOLS=`dirname $0`

mkdir tmpdir
cd tmpdir

lftp -f $TOOLS/backup_tikifiles.lftp

tar -czf backup.tar.gz * 
cd ../

d=`date +%F_%T`
mv tmpdir/backup.tar.gz backup_tikifiles_$d.tar.gz

rm -rf tmpdir

