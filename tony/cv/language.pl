#!/usr/bin/perl
#

use strict;
use warnings FATAL => 'all';
no warnings 'redefine';
use 5.10.0;

use CGI;
use CGI::Carp qw(fatalsToBrowser);
use JSON;

sub language()
{
    my $cgi = new CGI;
    my @langs = split /,/, $cgi->http('Accept-Language');
    map { s/;.*// } @langs;
    my $lang;
    foreach (@langs) {
	($lang = $_) =~ s/-.*//, last if /^e(n|s)/;
    }
    $lang = 'ex' unless $lang;
    print $cgi->header(-type => 'application/json');
    my $json = new JSON;
    print $json->utf8->encode( { language => $lang } );
}
language;
