#!/usr/bin/perl
#

use strict;
use warnings FATAL => 'all';
no warnings 'redefine';
use 5.10.0;

use CGI qw();
use CGI::Carp qw(fatalsToBrowser);
use Data::Dumper;

sub cv()
{
    my $cgi = new CGI;
    my $host = $cgi->http('host');
    print $cgi->redirect("http://$host/cv/");
}
cv;
