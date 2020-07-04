#!/usr/bin/perl
#

use 5.10.0;
use strict;
use warnings;

use CGI ();
use CGI::Carp q(fatalsToBrowser);
use Data::Dumper;

my $cgi = new CGI;

sub heading()
{
    print $cgi->header(-charset => 'utf-8');
    print $cgi->start_html(-head => [
	$cgi->Link(
	    {
		-rel    => 'shortcut icon',
		-href   => '/favicon.ico',
		-type   => 'image/x-icon'
	    },
	),
	],
	-title => q(Configuring the Mail Server to discard Spam),
	-script	=>  [
	{
	    -src    =>	'http://www.google-analytics.com/urchin.js',
	    -type   =>	'text/javascript',
	}
	],
	-style	=> {
	    -src	=> '/css/maybe.css',
	},
	-lang	=> 'en-GB',
	-declare_xml	=> 1,
	-encoding	=> 'utf-8',
    );
}

sub footer()
{
    print $cgi->end_html;
}

sub page()
{
    print $cgi->div( { -class => 'logo' },
	$cgi->img(
	    {
		-src	=> '/images/maybe.gif',
		-alt	=>  'May.BE Logo',
	    }
	),
    );
    print $cgi->div( { -class => 'page' },
	$cgi->p(<<html,
This is a guide to setting up a rule to deal with spam on a
mail server managed within the may.be domain.
html
	),
	$cgi->p(<<html,
First, log into your server using your web browser.  The correct address
is https://mail.&lt;your domain&gt;.  For example, users with a may.be address
can log in at
html
	    $cgi->a({-href => q(https://mail.may.be/) },
		q(https://mail.may.be)
	    ),
	    <<html,
while users with a britlore.co.uk email address should use
html
	    $cgi->a({-href => q(https://mail.britlore.co.uk/) },
		q(https://mail.britlore.co.uk)
	    ),
	    q(.),
	), #</p>
	$cgi->p(<<html,
Now you have a choice:
html
	), #</p>
	$cgi->ol({-type => 'i'},
	    $cgi->li(<<html,
You can discard all mail as spam if it has a SpamAssassin
value of 5.0 or greater or
html
	    ),
	    $cgi->li(<<html,
You can store mail with a SpamAssassin value of between 5.0
and 8.0 into a spam mailbox for manual checking later.
html
	    ), #li
	), #ol
	$cgi->p(
	    q( Either way, these are the steps needed to set up the rule:)
	),
	$cgi->ul(
	    $cgi->li(
		q(log into the correct server),
	    ), #li
	    $cgi->li(
		q(go into),
		$cgi->code(q(Mail Control &rarr; Rules)),
		q(and type), $cgi->b(q(Spam)),
		q( into the name box),
	    ), #li
	    $cgi->li(q(click),
		$cgi->code(q(Add Rule)),
	    ), #li
	    $cgi->li(<<html,
you should now see a rule called Spam with a priority of 5.  Click
html
		$cgi->code(q(Edit)),
		q(alongside the rule.),
	    ), #li
	    $cgi->li(q(in the Data column, select),
		$cgi->code(q(Header Field)),
	    ), #li
	    $cgi->li(
		q(under Operation, select),
		$cgi->code(q(is)),
	    ), #li
	    $cgi->li(
		q(in the box under Operation, type in),
		$cgi->b(q(X-SPAM: YES*)),
		q((not forgetting the final *).),
	    ), #li
	    $cgi->li(
		q(now if you simply wish to discard all mail marked as spam),
		$cgi->ul(
		    $cgi->li(
			q(select),
			$cgi->code(q(Discard)),
			q(under the Action.),
		    ), #li
		), #ul
	    ), #li
	    $cgi->li(
		q(if you prefer to store your suspect mail for later review),
		$cgi->ul(
		    $cgi->li(
			q(choose),
			$cgi->code(q(Store in)),
			q(under action),
		    ), #li
		    $cgi->li(q(enter),
			$cgi->b(q(Spam)), q(as the Parameter. ),
		    ), #li
		    $cgi->li(
			q(You will then need to update and make the next rule),
			$cgi->code(q(Discard)),
			q(or you will get two copies.),
		    ), #li
		), #ul
	    ), #li
	    $cgi->li(
		q(now click), $cgi->code(q(Update)),
		q(and you're done.),
	    ), #li
	), #ul
	$cgi->p(<<html,
Don't forget actually to create a top-level folder called
<b>Spam</b> if you decided to save the suspect mail.  This may be done either
in your mail client (Outlook, Thunderbird or whatever)
or using the web interface under
html
	    $cgi->code(q(Folders)),
	    q(where your INBOX is shown),
	), #p
	$cgi->p(<<html,
Any problems
(or even if you don't feel confident in setting this up yourself)
please do
html
	    $cgi->a({-href => q(mailto:cliff@may.be)},
		q(mail me),
	    ), #a
	    q(and I'll be happy to do it for you.),
	), #p
    ); # </div>
}

# main()
heading;
page;
footer;
