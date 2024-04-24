#!/bin/sh

# Make tar.gz distribution of Self Service Password
# Usage:
# * Run from current directory
# * Set version as parameter
# Example:
# ./makedist.sh 0.4

# Get version
VERSION=$1

# Program name
NAME=ltb-project-self-service-password

# Remove previous packages if any
rm -f $NAME*

# Create dist dir
mkdir -p $NAME-$VERSION
mkdir -p $NAME-$VERSION/conf
mkdir -p $NAME-$VERSION/htdocs
mkdir -p $NAME-$VERSION/lang
mkdir -p $NAME-$VERSION/lib
mkdir -p $NAME-$VERSION/rest
mkdir -p $NAME-$VERSION/scripts
mkdir -p $NAME-$VERSION/templates

# Copy files
cp ../README.md   $NAME-$VERSION
cp ../LICENCE     $NAME-$VERSION
cp ../conf/*      $NAME-$VERSION/conf
cp -a ../htdocs/* $NAME-$VERSION/htdocs
cp ../lang/*      $NAME-$VERSION/lang
cp -a ../lib/*    $NAME-$VERSION/lib
cp -a ../rest/*   $NAME-$VERSION/rest
cp ../scripts/*   $NAME-$VERSION/scripts
cp ../templates/* $NAME-$VERSION/templates

# Download composer dependencies
cp ../composer* $NAME-$VERSION
composer -d $NAME-$VERSION update --no-dev
rm $NAME-$VERSION/composer*

# Create archive
tar -cf $NAME-$VERSION.tar $NAME-$VERSION/

# Compress
gzip $NAME-$VERSION.tar

# Remove dist dir
rm -rf $NAME-$VERSION

# I am proud to tell you that I finished the job
echo "Archive build: $NAME-$VERSION"

# Exit
exit 0
