#!/bin/sh

TOOLS=$(cd `dirname $0` && pwd)
set -e
set -x
DOCDIR=coho-documents-mirror

cd ~/
rm -rf $DOCDIR
mkdir -p $DOCDIR
cd $DOCDIR

lftp -f $TOOLS/documents-fetch.lftp

