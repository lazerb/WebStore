#include "stdio.h"
#include "stdlib.h"
#include "string.h"
#define BUFFER_SIZE 1024
#define NAME_SIZE 20

int main (int argc, char * argv[]) {
	
	//Open file
	FILE * file = fopen("../webstore/source/members.csv", "rt");
	if (!file) {
		printf("Content-Type:text/html\n\n");
		printf("<html><head>");
		printf("<?php include (\"header.php\"); ?></head>");
		printf("<body><br>Could not open members.csv </body></html>");
		return 0;
	}
	char user[NAME_SIZE];
	char pass[NAME_SIZE];
	char buffer[BUFFER_SIZE];
	char input;
	int userChecked = 0;
	int passChecked = 0;
	int count = 0;
	int length = 0;
	
	//reads from POST
	int a =0;
	int n = atoi(getenv("CONTENT_LENGTH"));
	int equals =0;
	int amper =0;	
	int ucount = 0;
	int pcount =0;
	char firstLetter;
	
	printf("Content-Type:text/html\n\n");
	while((input=getchar())!=EOF && a<n){

		if(a<NAME_SIZE){
			if(input != '=' && input != '&' && input !='\r' && input != '\n' && input != '\0'){
				if(amper==0 && equals==1){
					user[a]=input;
					user[a+1]= '\0';
					a++;
					ucount++;
				}	
				if(amper==1 && equals==2){
					pass[a]=input;
					pass[a+1] = '\0';
					pcount++;
					a++;
				}	
			}
			if(input == '='){
				equals++;
				a=0;
			}
			if(input == '&'){
				amper++;
			}
			
		}
	
	}
	input = '\0';

	while ((input = getc(file)) != EOF) {

		//Check if comma, then
		if (input == ',') {
			//Check if username not yet checked
			if (!userChecked) {
				if (strncmp(user,buffer, ucount) == 0) {
					userChecked = 1;
				}
					strcpy(buffer, "");
					length = 0;
					continue;
			} else {
				//If checked username, check for password next
				
				if (strncmp(pass,buffer, pcount) == 0) {
					//append username to loggedin.csv
					FILE* appending = fopen("../webstore/source/loggedin.csv", "at");
					
					int q=0;
					for (q; q<ucount; q++){
						fputc(user[q], appending);
					}
					fputc('\n', appending);

					char usern[ucount+1];
					strncpy(usern, user, ucount);
printf("<html><META http-equiv=\"refresh\" content=\"0;URL=../webstore/source/catalogue.php?username=%s\"></html>", usern);
					fclose(appending);
					return 0;
				}
				strcpy(buffer, "");
				length = 0;
			}
		} else if (input == '\n') {
                        //Reset variables for next line
                        length = 0;
                        strcpy(buffer, "");
                        userChecked = 0;
                } else {
			buffer[length] = input;
			buffer[length + 1] = '\0';
			length++;
		}
	} 

	printf("<html><META http-equiv=\"refresh\" content=\"0;URL=../webstore/source/redirect.php\"></html>");
	fclose(file);
	return 0;
}

