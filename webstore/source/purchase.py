#!/usr/bin/env python
import cgi
import sys
import os
import stat
import csv

def loggedIn(user):
	#remove whitespace from user
	user= user.rstrip()
	try:
                log = open("loggedin.csv")
                reader = log.readlines()
  		for line in reader:
			#remove whitespace from line
			#test if user matches any entries in loggedin.csv
			line= line.rstrip()
			if user == line:
                        	return True	
		return False
        except IOError:
                print "Error opening loggedin.csv"
        	return False
	log.close()

def shoppingCart():
	form = cgi.FieldStorage()
	print "<title>Shopping Cart</title>"
	print "<br><br><center><table style=\"width:75%\"><tr><td>"
	print "<h1> shopping cart<br> </h1>"
	try:
		total = 0
		index = 0
		inventory = open("spices.csv", "r")
		reader = inventory.readlines()
		inventory.close()
		writer = open("spices.csv", "w")
		for line in reader:
			parsed = line.split(",", 4)
			#check for empty line
			if len(parsed)==0:
				break

			#check quantity requested
			quantity = form[parsed[0]].value		

			#if stock is greater than ordered quantity
			if int(quantity) > 0 and int(quantity) <= int(parsed[1]):
				print "<h3 style=\"padding:0px;margin:0px\">%s</h3>" %parsed[0]
				print "%s kg" %quantity		
				#calculate price
				price = int(form[parsed[0]].value) * int(parsed[2])
				print "(%s BTC)<br><br>" %price
				total = int(total)+int(price)
				#subtract quantity from inventory
				stock = parsed[1]
				parsed.remove(parsed[1])
				parsed.insert(1,int(stock)-int(quantity))
		
			#if ordered quantity exceeds stock can only give them stock	
			elif int(quantity) > int(parsed[1]):
				print "%s:" %parsed[0]
				if int(parsed[1])==0:
					print "out of stock"
					price=0
					print "<br><br>"
				else:
					print "%s kg " %parsed[1]
					#calculate price
					price = int(parsed[1])*int(parsed[2])
					print "(%s BTC)<br>" %price
					print "<br>"
					#set inventory = 0
					parsed[1] = '0'
				total=int(total)+int(price)
			check = 0
			for item in parsed:
				if check==1:
					writer.write(",")
				writer.write("%s" %item)
				check =1
		
				
		print "<hr width=20% align=left>"
		print "total = %s BTC" %total
		total = 0
		writer.close()
		return
	except IOError:
		print "Error accessing inventory"
		return


def main():	
	print "Content-Type: text/html\n"
	form = cgi.FieldStorage()
	#read username from form
	if form.has_key("username") and form["username"].value != "":
		user = form["username"].value
		print "<html><body>"
		print open('header.php').read()
		if loggedIn( user ):
			shoppingCart()
			print "<h4>"
			print"<a href=\"catalogue.php?username=%s\">keep shopping</a><br>" %user
			print"<a href=\"index.php\">return to homepage</a><br>"	
			print"</h4>"
	else: 
		print"User not logged in"
		print"<br><a href=\"catalogue.php\">return to catalogue</a>"
	print "</body></html>"
main()
