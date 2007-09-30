#!/bin/sh
# release.sh: Deploy a new version of the cohomeals program
# on cohoecovillage.org.

set -e

if [ -z "$1" ] || [ "$1" == "-h" ] ; then
  echo "Usage: $0 revision"
  echo
  echo "  revision: subversion revision to deploy"
  echo
  exit 1
fi

set -x

REVISION=$1

RELEASE=$(cd `dirname $0` && pwd)
REPOSITORY=$(cd `dirname $0` && svn info ../../ | sed -n 's/^URL: //p')

mkdir -p ~/temp/
cd ~/temp/
rm -rf cohomeals-$REVISION
svn export -r$REVISION $REPOSITORY cohomeals-$REVISION
cd cohomeals-$REVISION

# Remove any files which are not meant to be copied to cohoecovillage.org. 
for f in `cat $RELEASE/release.exclude`; do
  rm -r $f
done

# Mirror the current directory to cohoecovillage.org/meals/.
lftp -f $RELEASE/release.lftp

