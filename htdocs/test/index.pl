#!/usr/bin/perl
#

use strict;
use warnings;
use 5.10.0;

use CGI;
use CGI::Carp q(fatalsToBrowser);
use Data::Dumper;
use JSON;

my $cgi = new CGI;

print $cgi->header(-type => 'text/plain');

my @langs = split /,/, $cgi->http('Accept-Language');
map { s/;.*// } @langs;
my $lang;
foreach (@langs) {
    ($lang = $_) =~ s/-.*//, last if /^e(n|s)/;
}
$lang = 'es' unless $lang;

my $json = new JSON;
say $json->utf8->pretty->encode( { language => $lang} );


$Data::Dumper::Sortkeys = 1;
print Dumper \@langs, \%ENV;
