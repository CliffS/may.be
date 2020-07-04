#!/usr/bin/perl
#

use strict;
use warnings;

use CGI::Pretty;
use WWW::Google::PageRank;
use CGI::Ajax; 
use Lingua::EN::Numbers qw(num2en);

sub getit($)
{
    my $url = shift;
    $url = "http://$url" unless $url =~ /^http:/;
    $url =~ s{/$}{};
    my $pr = new WWW::Google::PageRank;
    my $rank = $pr->get($url);
    if ($rank)
    {
	($rank = num2en($rank)) =~ s/./\u$&/;
    }
    else {
	$rank = "Unknown";
    }
    my $link = qq(<a href="$url">$url</a>);
    return "$link has a Pagerank of <b>$rank</b>.";
}

#    <div class="logo">
#      <img src="/images/maybe.gif" alt="May.BE Logo" />
#    </div>
#    <table class="mainpage">

sub pagerank()
{
    my $cgi = new CGI;
    $cgi->charset('utf-8');
    my %header = (
	-charset => 'utf-8',
	-expires => '-1d',
	-cache_control => 'private, no-store, no-cache, must-revalidate',
	-pragma => 'no-cache',
	-lang => 'en-GB',
    );
    my $js = <<eos;
_uacct = "UA-3038629-3";
urchinTracker();
eos
    my $html .= $cgi->start_html(
	-title => "Google PageRank",
	-style => "/css/maybe.css",
	-script => [
	{ -src => "http://www.google-analytics.com/urchin.js" },
	<<eos
_uacct = "UA-3038629-3";
urchinTracker();
eos
	]
    );
    $html .= $cgi->div({-class => 'logo'},
	$cgi->img({-src => '/images/maybe.gif', -alt => 'May.BE Logo'}),
	);
    $html .= $cgi->h1("Google PageRank");
    $html .= $cgi->div({-class => 'formwrapper'},
	$cgi->start_form(),
	"Input the URL to check:",
	$cgi->textfield(
	    -id => 'website',
	    -name => 'website',
	    -size => 50,
	),
	$cgi->submit(
	    -name => "Check",
	    -onclick => "jsgetit( ['website'], ['result']); return false;"
	),
	$cgi->end_form,
	$cgi->div({
		-id => "result",
		-class => 'result'
	    },
	    " ",
	),
	$cgi->div({-class => 'result'},
	    "For more information, go to",
	    $cgi->a(
		{
		    -href => 'http://www.moneyblogger.org/2008/01/12/google-update/',
		    -target => "_blank",
		},
		"www.moneyblogger.org."
	    ),
	),
	$cgi->div({-class => 'result'},
	    "I'm Cliff Stanford.  Please",
	    $cgi->a(
		{ -href => 'mailto:cliff@may.be?subject="Google PageRank"' },
		"mail me"
	    ),
	    "with any comments or suggestions for improvements."
	),

    );
    $html .= $cgi->end_html;
    my $click = new CGI::Ajax(jsgetit => \&getit);
    print $click->build_html($cgi, $html, \%header);
}


pagerank;
