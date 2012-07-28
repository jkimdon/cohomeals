#!/bin/sh
# file_importer.sh : script for archive - major file import

if [ -z "$1" ] ; then
	echo "Usage: $0 file"
	echo "Where 'file' is of the format:"
	echo "<id> <filename>"
	exit
fi

INPUTFILE=$1

DOCSDIR="/home/jkimdon/coho-documents-mirror"
HOST=http://moo/meals/tikitest
#HOST=https://www.cohoecovillage.org/tiki

TIKIUSER=admin
#TIKIUSER=
TIKIPASS=joeyjodw
#TIKIPASS=

#echo "Logging in"

# get initial cookies
curl -c cookies.txt -o initial-load.html $HOST/tiki-login_scr.php

# post the login form and follow redirects, maintaining cookie state
curl -L -d "user=$TIKIUSER&pass=$TIKIPASS&login=Log+in&stay_in_ssl_mode_present=y&stay_in_ssl_mode=n" -o out.html -c cookies.txt -b cookies.txt -o login.html $HOST/tiki-login.php

#GALLERY_ID=89
#LOCALPATH="documents/Teams/CommonHouse/Minutes/CH2010 Minutes/CH20100130.pdf"

cat $INPUTFILE | while read GALLERY_ID LOCALPATH; do

curl \
	-c cookies.txt \
	-b cookies.txt \
	-F "formId=0" \
	-F "simpleMode=n" \
	-F "name[]=$(basename "$DOCSDIR/$LOCALPATH")" \
	-F "description[]=" \
	-F "userfile[]=@$DOCSDIR/$LOCALPATH" \
	-F "galleryId[]=$GALLERY_ID" \
	-F "user=admin" \
	-F "author[]=" \
	-F "cat_managed[]=3" \
	-F "cat_managed[]=1" \
	-F "cat_categories[]=5" \
	-F "cat_managed[]=5" \
	-F "cat_managed[]=4" \
	-F "cat_managed[]=6" \
	-F "cat_managed[]=2" \
	-F "cat_categorize=on" \
	-F "upload=" \
	-o upload.html \
	$HOST/tiki-upload_file.php
done

