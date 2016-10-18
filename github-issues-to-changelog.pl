#!/usr/bin/perl
#
# Script to parse Github JSON API response and convert to changelog
# Usage: curl 'https://api.github.com/repos/ltb-project/self-service-password/issues?milestone=MILESTONE&state=all&direction=asc' | perl github-issues-to-changelog.pl
 
use JSON;

my $input;
while(<>) { $input .= "$_\n"; }

my $json = decode_json $input;

# Debian changelog
print "# Debian\n";
foreach my $issue (@$json) {
    print "    * gh#" . $issue->{number} .": " . $issue->{title} . "\n";
}
print "\n";

# RPM changelog
print "# RPM\n";
foreach my $issue (@$json) {
    print "- gh#" . $issue->{number} .": " . $issue->{title} . "\n";
}
print "\n";

# GitHub changelog
print "# GitHub\n";
foreach my $issue (@$json) {
    print "* #" . $issue->{number} .": " . $issue->{title} . "\n";
}
print "\n";

# Release contributors
print "# Contributors\n";
foreach my $issue (@$json) {
    print "Author of issue #" . $issue->{number} .": " . $issue->{user}->{login} . "\n";
}


exit 0;
