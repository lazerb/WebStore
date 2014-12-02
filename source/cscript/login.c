#include<stdio.h>
#include<string.h>
#define SIZE 100

int main() {

char username[SIZE];
char password[SIZE];

printf("please enter username\n");
fgets(username, SIZE, stdin);

printf("please enter password\n");
fgets(password, SIZE, stdin);

FILE* fp = fopen("members.csv", "rt");

	if (fp == NULL){
		printf("<head><title>ERROR OPENING members.csv</title></head>");
		return 0;	
	}

char c;
char line[SIZE];
int i = 0;
const char delim[2] = ",";
char *name;
char *user;
char *pword;
FILE *appending;

while(feof(fp) == 0){
	c = fgetc(fp);
	
	while(c != '\r' && c != '\n'){
		line[i] = c;
		line[i+1] = '\0';
		i++;
	}
	if(c== '\r'){
		//when \r is reached, parse the line into name, username, and password
		char *theline; 
		strcpy(theline, line);
		name=strtok(theline, delim);
		user=strtok(NULL, delim);
		pword=strtok(NULL, delim);	
	}

	if(c=='\n'){
		strcpy(line, "");
		i=0;
		c='\0';

		if(strcmp(user, username)==0){
			printf("username matches and is %s\n", user);		

			if(strcmp(pword, password)==0){
				printf("password is%s\n", pword);

				/*append user's username into loggedin.csv file
				appending = fopen("loggedin.csv", "at");
					if(appending==NULL){
						printf("Content-Type: text/html\n\n");
						printf("<html><head><title>ERROR OPENING loggedin.csv</title></head></html>");
						return 0;
					}
				fputs(user, appending);	
				fclose(appending);		

				//display catalogue page
				printf("<META http-equiv=\"refresh\" content=\"1;URL=http://www.cs.mcgill.ca/~tbotwi/webstore/source/catalogue.php\">");	
				//insert hidden field and assign name to that field*/
			
			return 0;
			}	
		}
	}	

//no match found for username, display error HTML page with link back to login page
	printf("Content-Type: text/html\n\n");
	printf("<html>");
	printf("<head><title>Error: No match found for given username!</title>");
	printf("<a \"href=http://cs.mcgill.ca/~lweint/webstore/login.php\">Return to login page</a>");
	printf("</head></htmll>");	
	
fclose(fp);
return 1;
}

}
