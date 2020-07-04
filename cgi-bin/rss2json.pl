#!/usr/bin/perl
#

use strict;
use warnings;
use 5.10.0;

use XML::Feed;
use CGI;
use CGI::Carp q(fatalsToBrowser);
use URI;
use JSON::XS qw();
use LWP::UserAgent;
use OOPS;
use Encode;
use DateTime::Format::Mail;
use Digest::MD5;
use Carp;

use experimental 'switch';

use Data::Dumper;

$SIG{__DIE__} = sub {
    my $err = shift;
    logger ("Died: $err") unless $^S;
};

sub logger($)
{
    open my $log, '>>/tmp/rss2json.log' || die "Can't open Log File";
    say $log DateTime->now, " ", shift;
    close $log;
}

sub dbopen()
{
    my $path = "";
    ($path = $ENV{SCRIPT_FILENAME}) =~ s/\w+\.pl$// if $ENV{SCRIPT_FILENAME};
    $path .= 'database/rss2json.sqlite';
    my $oops = new OOPS(dbi_dsn => "dbi:SQLite:dbname=$path");
    return $oops;
}

sub findfeeds($)
{
    my $url = shift;
    my @feeds = find_feeds XML::Feed($url);
    return @feeds;
}

sub getfeed($)
{
    my $url = shift;
    my $data;
    transaction(
	sub {
	    my $oops = dbopen;
	    my $etag = $oops->{$url}->{etag};
	    my $agent = new LWP::UserAgent;
	    my @params;
	    @params = ('If-None-Match' => $etag) if $etag;
	    my $rsp = $agent->get($url, @params);
	    if ($rsp->code == 304)
	    {
		$data = $oops->{$url}->{data};
		$data = decode_utf8($data);
	    }
	    elsif ($rsp->code == 200)
	    {
		$data = $rsp->decoded_content;
		$etag = $rsp->header('Etag');
		if ($etag)
		{
		    $oops->{$url}->{etag} = $etag;
		    $oops->{$url}->{data} = encode_utf8($data);
		    $oops->commit;
		}
	    }
	    else {
		die "Response of " . $rsp->code;
	    }
	    my $tries = $OOPS::transaction_tries;
	}
    );
    my $feed = parse XML::Feed(\$data);
    return $feed;
}

sub dereference($)
{
    my $txt = shift;
    if (ref $txt)
    {
	given ($txt) {
	    when ($txt->isa('XML::Feed::Content')) {
		$txt = $txt->body;
	    }
	    when ($txt->isa('DateTime')) {
		local $SIG{__DIE__};
		$txt = DateTime::Format::Mail->format_datetime($txt);
	    }
	    default {
		die ref $txt;
	    }
	}
    }
    return $txt;
}

sub getdata($)
{
    my $feed = shift;
    local $_;
    my %data;
    foreach (qw(title base link description author language copyright modified))
    {
	$data{$_} = dereference $feed->$_;
    }
    my @hasharray;
    my @entries = $feed->entries;
    foreach my $entry (@entries)
    {
	my %hash;
	foreach (qw(title link content summary category author issued))
	{
	    $hash{$_} = dereference $entry->$_;
	}
	push @hasharray, \%hash;
    }
    $data{entries} = \@hasharray;
    return \%data;
}

sub getjson($$)
{
    my $data = shift;
    my $pretty = shift;
    my $json = new JSON::XS->utf8->canonical;
    $json->pretty if $pretty;
    return $json->encode($data);
}

sub getetag($)
{
    my $data = shift;
    my $md5 = new Digest::MD5;
    $md5->add($data);
    my $result = $md5->hexdigest;
    return $result;
}

sub main()
{
    my $cgi = new CGI;
    my $pretty = $cgi->param('pretty');
    my $type = $pretty ?  'text/plain' : 'application/json';
    my $url = $cgi->param('url');
    $url = "http://$url" unless $url =~ m{^\w+://};
    die "No URL" unless $url;
    my $feed = getfeed($url);
    die "No Feed" unless $feed;
    my $data = getdata $feed;
    my $json = getjson $data, $pretty;
    my $callback = $cgi->param('callback');
    my $response = $callback ? "$callback($json);" : $json;
    my $ifnone = $ENV{HTTP_IF_NONE_MATCH};
    my $etag = getetag $response;
    my @headers = (
	-type => $type,
	-charset => 'utf-8',
	-expires => '+1h',
	-Etag => $etag,
    );
    if ($ifnone && ($ifnone eq $etag))
    {
	push @headers, '-status' => '304 Not Modified';
	print $cgi->header(@headers);
	logger "Success: $url - 304";
    }
    else {
	print $cgi->header(@headers);
	print $response;
	logger "Success: $url - 200";
    }
}

main;
