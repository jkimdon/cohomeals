#!/bin/sh
# backup.sh : script to backup the cohoecovillage.org meal database 

TOOLS=`dirname $0`

echo "Getting token"
curl \
	--basic --user cohou3:Coho9999 \
	-c cookies.txt \
	--cacert $TOOLS/hathor.lunarpages.com.pem \
	-o backup.tmp \
	https://hathor.lunarpages.com:2083/3rdparty/phpMyAdmin/server_export.php

token=`sed -n 's/.*\(token=[0-9a-f]*\).*/\1/p' < backup.tmp  | head -1`

echo "Downloading backup"
curl \
	--basic --user cohou3:Coho9999 \
	-b cookies.txt \
	--cacert $TOOLS/hathor.lunarpages.com.pem \
	-o backup.sql \
	-d $token \
	-d 'export_type=server&db_select%5B%5D=cohou3_meals&what=sql&csv_separator=%3B&csv_enclosed=%26quot%3B&csv_escaped=%5C&csv_terminated=AUTO&csv_null=NULL&csv_data=&excel_null=NULL&excel_edition=Windows&excel_data=&htmlexcel_null=NULL&htmlexcel_data=&htmlword_structure=something&htmlword_data=something&htmlword_null=NULL&latex_caption=something&latex_structure=something&latex_structure_caption=Structure+of+table+__TABLE__&latex_structure_continued_caption=Structure+of+table+__TABLE__+%28continued%29&latex_structure_label=tab%3A__TABLE__-structure&latex_comments=something&latex_data=something&latex_columns=something&latex_data_caption=Content+of+table+__TABLE__&latex_data_continued_caption=Content+of+table+__TABLE__+%28continued%29&latex_data_label=tab%3A__TABLE__-data&latex_null=%5Ctextit%7BNULL%7D&ods_null=NULL&ods_data=&odt_structure=something&odt_comments=something&odt_data=something&odt_columns=something&odt_null=NULL&pdf_report_title=&pdf_data=1&sql_header_comment=&sql_compatibility=NONE&sql_structure=something&sql_auto_increment=something&sql_drop_table=something&sql_backquotes=something&sql_data=something&sql_max_query_size=50000&sql_hex_for_binary=something&sql_type=INSERT&asfile=sendit&filename_template=__SERVER__&remember_template=on&compression=none' \
	https://hathor.lunarpages.com:2083/3rdparty/phpMyAdmin/export.php

d=`date +%F_%T`
cp backup.sql backup_$d.sql

cat backup.sql | sed 's/^CREATE DATABASE/--/' > backuptmp.sql
cat backuptmp.sql | sed 's/^USE/--/' > backup.sql

rm -f backup.tmp
rm -f backuptmp.sql


echo "Backup written to 'backup.sql'"
