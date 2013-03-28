#!/usr/bin/perl -w
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#==============================================================================
# Check all strings in lang files to discover missing translations
#==============================================================================

use strict;
use utf8;

my @lang = qw/ca de es fr it nl pl pt-BR ru sk/;
my $strings;

# Scan english file
open( EN, '<lang/en.inc.php' ) or die 'Cannot open file $@!';

while (<EN>) {
    if ( $_ =~ /^\$messages\[\'(\w+)\'\]\s*=\s*(.+)\;$/ ) {
        $strings->{$1} = $2;
    }
}

close(EN);

# Scan other files

foreach my $lang (@lang) {

    open( LANG, '<lang/' . $lang . '.inc.php' ) or die 'Cannot open file $@!';

    my $lang_strings  = undef;
    my $lang_errors   = 0;
    my $lang_warnings = 0;
    my $lang_patch    = undef;
    my $lang_watch    = undef;

    while (<LANG>) {
        if ( $_ =~ /^\$messages\[\'(\w+)\'\]\s*=\s*(.+)\;$/ ) {
            $lang_strings->{$1} = $2;
        }
    }
    close(LANG);

    say STDOUT "\n=== Scan result for lang $lang ===\n";

    foreach ( keys $strings ) {
        if ( !$lang_strings->{$_} ) {
            say STDOUT "Key $_ do not exists in lang $lang";
            $lang_errors++;
            $lang_patch->{$_} = $strings->{$_};
        }
        elsif ( $lang_strings->{$_} eq $strings->{$_} ) {
            say STDOUT
"Same value for $_ in lang $lang than in English, missing translation?";
            $lang_warnings++;
            $lang_watch->{$_} = $strings->{$_};
        }
        else {
            say STDOUT "Key $_ ok in lang $lang";
        }
    }

    say STDOUT "\nFound $lang_errors errors and $lang_warnings warnings";

    if ($lang_patch) {
        say STDOUT "\nLines to add to $lang.inc.php:";
        foreach ( keys $lang_patch ) {
            say STDOUT "\$messages['$_'] = " . $lang_patch->{$_} . ";";
        }
    }

    if ($lang_watch) {
        say STDOUT "\nMessages to watch in $lang.inc.php:";
        foreach ( keys $lang_watch ) {
            say STDOUT "\$messages['$_'] = " . $lang_watch->{$_} . ";";
        }
    }
}

