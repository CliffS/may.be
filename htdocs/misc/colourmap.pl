#!/usr/bin/perl
#

use strict;
use warnings;

use CGI;

my $cgi = new CGI;

print $cgi->header,
    $cgi->start_html(-lang => 'en-GB', -encoding => 'utf-8',
	-title => 'Colour Mappings');

my @colours = qw(
aliceblue antiquewhite aqua aquamarine azure beige bisque black blanchedalmond
blue blueviolet brown burlywood cadetblue chartreuse chocolate coral
cornflowerblue cornsilk crimson cyan darkblue darkcyan darkgoldenrod darkgray
darkgreen darkgrey darkkhaki darkmagenta darkolivegreen darkorange darkorchid
darkred darksalmon darkseagreen darkslateblue darkslategray darkslategrey
darkturquoise darkviolet deeppink deepskyblue dimgray dimgrey dodgerblue
firebrick floralwhite forestgreen fuchsia gainsboro ghostwhite gold
goldenrod gray grey green greenyellow honeydew hotpink indianred indigo
ivory khaki lavender lavenderblush lawngreen lemonchiffon lightblue
lightcoral lightcyan lightgoldenrodyellow lightgray lightgreen lightgrey
lightpink lightsalmon lightseagreen lightskyblue lightslategray lightslategrey
lightsteelblue lightyellow lime limegreen linen magenta maroon mediumaquamarine
mediumblue mediumorchid mediumpurple mediumseagreen mediumslateblue
mediumspringgreen mediumturquoise mediumvioletred midnightblue mintcream
mistyrose moccasin navajowhite navy oldlace olive olivedrab orange
orangered orchid palegoldenrod palegreen paleturquoise palevioletred papayawhip
peachpuff peru pink plum powderblue purple red rosybrown royalblue saddlebrown
salmon sandybrown seagreen seashell sienna silver skyblue slateblue slategray
slategrey snow springgreen steelblue tan teal thistle tomato turquoise
violet wheat white whitesmoke yellow yellowgreen
);

print $cgi->start_table;

foreach (@colours)
{
    (my $colour = $_) =~ s/./\u$&/;
    print $cgi->Tr({-style => "background-color:$_"},
	$cgi->td({-style => "color:white"}, $colour).
	$cgi->td({-style => "color:black"}, $colour),
	$cgi->td({-style => "color:red"}, $colour),
	$cgi->td({-style => "color:green"}, $colour),
	$cgi->td({-style => "color:blue"}, $colour),
    );
}

print $cgi->end_table;

print $cgi->end_html;

