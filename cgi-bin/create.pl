#!/usr/bin/perl
#

use strict;
use warnings;
use 5.10.0;

use OOPS;

OOPS->initial_setup(
    dbi_dsn => q(dbi:SQLite:dbname=database/rss2json.sqlite),
);
