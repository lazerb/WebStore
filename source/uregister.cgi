#!/usr/bin/perl
use CGI qw(:standard);
use strict;

print '
Content-Type: text/html;
';
$userfile = './members.csv';

$fullname = param('fullname');
$username = param('username');
$password = param('password');
$confpass = param('confirmpassword');

print $fullname . $username . $password . $confpass;
my $q = new CGI;
read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
