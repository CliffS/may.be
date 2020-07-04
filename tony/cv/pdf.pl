#!/usr/bin/perl
#

use strict;
use warnings FATAL => 'all';
no warnings 'redefine';
use 5.10.0;

use CGI qw();
use CGI::Carp qw(fatalsToBrowser);
use Data::Dumper;

sub pdf()
{
    my $cgi = new CGI;
    my $lang = $cgi->cookie('language') || 'es';
    my $filename = $lang eq 'es' ? 'Hoja de Vida Tony Stanford' : 'Tony Stanford CV';
    my $cv = $lang eq 'es' ? 'Hoja de Vida' : 'Curriculum Vitae';
    my $size = $lang eq 'en' ? 'A4' : 'Letter';
    print $cgi->header(
	-type => 'application/pdf',
	-content_disposition => qq(attachment;filename="$filename.pdf")
    );
    # print $cgi->header(-type => 'text/plain');
    my $host = $cgi->http('host') || 'proof.tony.may.be';
    (my $path = $cgi->script_name) =~ s{[^/]*$}{};
    $path = '/cv/' unless $path;
    my $page = sprintf '%s [page] %s [topage]',  $lang eq 'en' ? qw(Page of) : qw(Página de);
    my $options = qq(--quiet --page-size $size --header-left '$cv' --header-font-size 10 --footer-center 'Page [page] of [topage]' --footer-font-size 8);
    my $pdf = qx(/usr/local/bin/wkhtmltopdf $options 'http://$host$path?language=$lang&print=true' -);
    print $pdf;
}
pdf;
