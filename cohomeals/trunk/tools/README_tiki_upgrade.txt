Backup:

files/
img/coho_custom/

(for calendar modification:)
tiki-calendar_edit_item.php
lib/calendar/calrecurrence.php
templates/tiki-calendar_edit_item.tpl
installer/schema/20101204_add_monthly_by_weekday_calendar_recurrence.sql

(for coho style:)
styles/coho.css
styles/coho/*
templates/styles/coho/*



Howto:

1. Local: go to the backup directory and run backup_tikidata.sh and backup_tikifiles.sh
2. lunarpages: rename www/tiki/ to www/tiki_old/ and make a new empty www/tiki/ directory
3. Local: Download and decompress new tiki version
4. Local: go into the new tiki directory and run: lftp -f tools/upgrade_tiki.lftp (to Ftp the new tiki files from local into a new www/tiki/ directory on lunarpages)
5. copy the custom files from www/tiki_old/ to www/tiki/ (currently: files/ and img/coho_custom/)
6. go to https://www.cohoecovillage.org/tiki and follow installer directions to upgrade the database
