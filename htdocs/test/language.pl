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
    my $accept = $cgi->http('Accept-Language');
    my $lang = 'es';
    if ($accept)
    {
	my @langs = split /,/, $cgi->http('Accept-Language');
	map { s/;.*// } @langs;
	foreach (@langs) {
	    ($lang = $_) =~ s/-.*//, last if /^e(n|s)/;
	}
    }
    print $cgi->header(-type => 'application/json');
    # print $cgi->header(-type => 'text/plain');
    my $json = new JSON;
    my $output = $json->utf8->encode( { language => $lang } );
    my $callback = $cgi->param('callback') || $cgi->param('jsonp_callback');
    $output = "$callback($output)" if $callback;
    print $output;
}
language;
