log.cgi : main.o
	gcc -o ~/public_html/cgi-bin/log.cgi main.o
	chmod 755 ~/public_html/cgi-bin/log.cgi

main.o : main.c
	gcc -c main.c

clean :
	rm main.o
