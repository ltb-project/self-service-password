#!/usr/bin/perl
#
# Script to parse Github JSON API response and convert to changelog
# Usage: curl 'https://api.github.com/repos/ltb-project/self-service-password/issues?milestone=MILESTONE&state=all&direction=asc' | perl github-issues-to-changelog.pl
 
use JSON;

my $input;
while(<>) { $input .= "$_\n"; }

my $json = decode_json $input;

foreach my $issue (@$json) {
    print "    * gh#" . $issue->{number} .": " . $issue->{title} . "\n";
}

exit 0;
