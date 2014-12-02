#!/usr/bin/perl
use CGI qw(:standard);
use CGI::Carp qw(fatalsToBrowser set_message);

BEGIN {
	sub errorhandler {
		$msg = shift;
		print "<br>Error: $msg ...Redirecting\n";
		print '<META http-equiv="refresh" content="3;URL=../webstore/source/registration.php">'
	}
	set_message(\&errorhandler);
}

print "Content-Type: text/html\n\n";
$userfile = "../webstore/source/members.csv";

$fullname = param('fullname');
$username = param('username');
$password = param('password');
$confpass = param('confirmpassword');

#Check if the user doesn't follow the rules
die "Password do not match." if $password ne $confpass;
die "Password not long enough." if length($password) < 1;
die "Full name required." if length($fullname) < 1;
die "Username not long enough." if length($username) < 1;

open FILE, "+<$userfile" or die "Failed to open file";
while ($line = <FILE>) {
	chomp $line;
	push @data, [split ",", $line];
}
close FILE;

foreach $row (@data) {
	if ($row->[0] eq $username) {
		die "Username $row->[0] is already in use.\n";
		$inuse = 1;
	}
}

open FILE, ">>$userfile" or die "Failed to open file";
if ($inuse ne 1) {
	print FILE "$username,$password,$fullname\n";
	print 'User created successfully! <a href="../webstore/source/catalogue.php?username=' . $username . '">Go to catalogue</a>' . "\n";
}
close FILE;
