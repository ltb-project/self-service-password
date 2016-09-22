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
mkdir -p $NAME-$VERSION/css
mkdir -p $NAME-$VERSION/fonts
mkdir -p $NAME-$VERSION/images
mkdir -p $NAME-$VERSION/js
mkdir -p $NAME-$VERSION/lang
mkdir -p $NAME-$VERSION/lib
mkdir -p $NAME-$VERSION/pages

# Copy files
cp ../*.php     $NAME-$VERSION
cp ../README.md $NAME-$VERSION
cp ../LICENCE   $NAME-$VERSION
cp ../conf/*    $NAME-$VERSION/conf
cp ../css/*     $NAME-$VERSION/css
cp ../fonts/*   $NAME-$VERSION/fonts
cp ../images/*  $NAME-$VERSION/images
cp ../js/*      $NAME-$VERSION/js
cp ../lang/*    $NAME-$VERSION/lang
cp ../lib/*     $NAME-$VERSION/lib
cp ../pages/*   $NAME-$VERSION/pages

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
