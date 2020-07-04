package USDA;

use strict;
use warnings;

use SOAP::Lite;
use File::stat;
use DBI;

sub sizeof($)
{
    my $file = shift;
    (my $path = $0) =~ s|/[^/]+$|/../USDA/$file|;
    my $st = stat $path or die "Can't stat $path";
    return $st->size;
}

sub CompressedSize
{
    shift;
    my $size = sizeof 'USDA.db.bz2';
    return SOAP::Data->name('CompressedSizeResult')->value($size);
}

sub unCompressedSize
{
    shift;
    my $size = sizeof 'USDA.db';
    return SOAP::Data->name('unCompressedSizeResult')->value($size);
}

sub getVersion
{
    shift;
    my $dbh = DBI->connect("dbi:SQLite:dbname=../USDA/USDA.db", "", "")
	|| die "Cannot Connect to Database: $!\n";
    my $sql = <<sql;
SELECT Data FROM CONFIG
WHERE Key LIKE '%Version'
ORDER BY Key DESC
sql
}



1;
