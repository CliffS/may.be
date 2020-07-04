#!/usr/bin/perl
#

use warnings;
use strict;
use 5.10.0;

use SOAP::Lite uri => 'USDA';

use SOAP::Transport::HTTP;

use lib '/home/httpd/may.be/live/htdocs/usda';

use USDA;

SOAP::Transport::HTTP::CGI->dispatch_to('USDA')->handle;
