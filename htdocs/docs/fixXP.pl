#!/usr/bin/perl
#

use 5.10.0;
use strict;
use warnings;

use CGI ();
use CGI::Carp q(fatalsToBrowser);
use Data::Dumper;

my $cgi = new CGI;

sub heading($)
{
	my $cgi = shift;
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
	-title => q(Windows XP Erroneous Validation Problem),
	-script	=>  [
	{
	    -src    =>	'http://www.google-analytics.com/urchin.js',
	    -type   =>	'text/javascript',
	},
	{
	    -type   =>	'text/javascript',
	    -code   =>	<<js,
      _uacct = "UA-3038629-3";
      urchinTracker();
js
	},
	],
	-style	=> {
	    -src	=> '/css/maybe.css',
	},
	-lang	=> 'en-GB',
	-declare_xml	=> 1,
	-encoding	=> 'utf-8',
    );
}

sub footer($)
{
	my $cgi = shift;
    print $cgi->end_html;
}

sub page($)
{
	my $cgi = shift;
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
This is a guide to fixing the erroneous message that
sometimes appears on installations of Windows XP where
the display background is forced to black and a pop-up
message states that
&ldquo;This copy of Windows XP did not pass genuine validation.&rdquo;
html
	),
	$cgi->p(<<html,
The Microsoft page referring to the display is at
html
	    $cgi->a({-href => q(http://support.microsoft.com/kb/905474)},
		q(http://support.microsoft.com/kb/905474)
	    ),
	    <<html,
but this does not provide a simple fix where the message is displayed
in error.  These instructions attempt to address that problem.
html
	), #</p>
	$cgi->p(q(Microsoft also provides),
	    $cgi->a({-href => q(http://www.microsoft.com/genuine/) },
		q(more information),
	    ),
	    <<html,
on genuine Microsoft software but I do find it odd that they even care
about Windows XP, three months after the final
html
	    $cgi->a({-href => q(http://www.microsoft.com/windows/lifecycle/default.mspx) },
		q(end-of-life date)
	    ),
	    <<html,
for the product.  Do Microsoft really believe that, by telling me
my copy of their
out-of-date product is not genuine, I am likely to 
go out and buy a copy of Vista?  I am much more likely
to remove Windows and to install a free copy of
html
	    $cgi->a({-href => "http://www.ubuntu.com/"},
		q(Ubuntu),
	    ),
	    q(Linux.),
	), #</p>
	$cgi->p(<<html,
To get rid of the messages:
html
	),
	$cgi->ol( { -type => 'i' },
	    $cgi->li(<<html
Reboot into &ldquo;Safe Mode&rdquo; (repeatedly tap F8 at startup)
html
	    ),
	    $cgi->li(
		q(Open a Command window: ),
		$cgi->code(q(Start &rArr; Run)),
		q( and enter ),
		$cgi->code(q(cmd)),
	    ),
	    $cgi->li($cgi->code(q(cd \Windows\System32)),
		q{[Location is now C:\Windows\System32]},
	    ),
	    $cgi->li($cgi->code(q(ren wgatray.exe wgatrayold.exe))),
	    $cgi->li($cgi->code(q(cd dllcache)),
		q{[Location is now C:\Windows\System32\dllcache]}
	    ),
	    $cgi->li($cgi->code(q(ren wgatray.exe wgatrayold.exe))),
	    $cgi->li(q(Close the Command window)),
	    $cgi->li(q(Run Regedit: ),
		$cgi->code(q(Start &rArr; Run)),
		q( and enter ),
		$cgi->code(q(regedit)),
	    ),
	    $cgi->li(<<'html',
Navigate to
HKEY_Local_Machine\Software\Microsoft\WindowsNT\CurrentVersion\Winlogon\Notify\WGALOGON
html
	    ),
	    $cgi->li($cgi->i(q{(Optional)}),
		<<'html',
Right Click &rArr; Export on the WGALOGON Folder
(as a backup)
html
	    ),
	    $cgi->li(q(Delete the WGALOGON Folder)),
	    $cgi->li(q(Close Regedit)),
	    $cgi->li(q(Reboot)),
	), # </ol>
    ); # </div>
}

# main()
heading $cgi;
page $cgi;
footer $cgi;
