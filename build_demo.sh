#!/bin/bash
SRC_DIR="src"
DEMO_DIR="demo"

declare -A VARS
VARS[RWB_EMAIL]="rwb@greatfire.org"

VARS[RWB_JQUERY_URL]="jquery-1.11.1.min.js"
VARS[RWB_REDIRECTION_URLS]="https://bbc1.azurewebsites.net https://github.com/greatfire/wiki"
VARS[RWB_TITLE]="Redirect When Blocked"

VARS[RWB_FALLBACK_INTRO]="This website could not be accessed. Alternative URLs:"
VARS[RWB_FALLBACK_THIS_URL]="This URL"
VARS[RWB_FALLBACK_EMAIL]="Or contact us by sending an email to"
VARS[RWB_FALLBACK_REDIRECTING]="redirecting"

VARS[RWB_VERSION]=$(date)

while read FILE; do
	
	DEMO_FILE=$DEMO_DIR/$FILE
	
	if [[ $FILE =~ rwb\..* ]]; then
			
		while read LINE; do
			
			if [[ $LINE =~ .*\{RWB_REDIRECTION_URL\}.* ]]; then
				
				for RWB_REDIRECTION_URL in ${VARS[RWB_REDIRECTION_URLS]}; do
					echo "$LINE" | sed "s,{RWB_REDIRECTION_URL},$RWB_REDIRECTION_URL,g"
				done
			else
				echo "$LINE"
			fi
			
		done < $SRC_DIR/$FILE | while read LINE; do
			for KEY in "${!VARS[@]}"; do 
				LINE=$(echo "$LINE" | sed "s,{$KEY},${VARS[$KEY]},g")
			done
			echo "$LINE"
		done \
		 > $DEMO_FILE
		
	else
		cp $SRC_DIR/$FILE $DEMO_FILE
	fi
	
done < <(ls $SRC_DIR)