#!/usr/bin/perl

use strict;
use warnings;
use 5.14.0;
use utf8;

use CGI::Simple;
use CGI::Carp qw{fatalsToBrowser};
use Data::Dumper;
$Data::Dumper::Sortkeys = 1;

my $cgi = new CGI::Simple;

print $cgi->header('text/plain');

print Dumper \%ENV;
