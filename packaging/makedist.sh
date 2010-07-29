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
mkdir -p $NAME-$VERSION/lang
mkdir -p $NAME-$VERSION/pages
mkdir -p $NAME-$VERSION/style

# Copy files
cp ../*.php $NAME-$VERSION
cp ../lang/* $NAME-$VERSION/lang
cp ../pages/* $NAME-$VERSION/pages
cp ../style/* $NAME-$VERSION/style

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
