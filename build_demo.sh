#!/bin/bash
SRC_DIR="src"
DEMO_DIR="demo"

RWB_EMAIL="rwb@greatfire.org"
RWB_JQUERY_URL="jquery-1.11.1.min.js"
RWB_REDIRECTION_URLS="https://bbc1.azurewebsites.net https://github.com/greatfire/wiki"
RWB_TITLE="Redirect When Blocked"

RWB_VERSION=$(date)

while read FILE; do
	
	DEMO_FILE=$DEMO_DIR/$FILE
	
	if [[ $FILE =~ rwb\..* ]]; then
			
		while read LINE; do
			
			if [[ $LINE =~ .*\{RWB_REDIRECTION_URL\}.* ]]; then
				
				for RWB_REDIRECTION_URL in $RWB_REDIRECTION_URLS; do
					echo "$LINE" | sed "s,{RWB_REDIRECTION_URL},$RWB_REDIRECTION_URL,g"
				done
			else
				echo "$LINE"
			fi
			
		done < $SRC_DIR/$FILE \
		| sed "s,{RWB_EMAIL},$RWB_EMAIL,g" \
		| sed "s,{RWB_JQUERY_URL},$RWB_JQUERY_URL,g" \
		| sed "s,{RWB_TITLE},$RWB_TITLE,g" \
		| sed "s,{RWB_VERSION},$RWB_VERSION,g" \
		 > $DEMO_FILE
		
	else
		cp $SRC_DIR/$FILE $DEMO_FILE
	fi
	
done < <(ls $SRC_DIR)