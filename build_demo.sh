#!/bin/bash
SRC_DIR="src"
DEMO_DIR="demo"

RWB_REDIRECTION_URLS="https://bbc1.azurewebsites.net https://github.com/greatfire/wiki"

declare -A VARS

VARS[RWB_REDIRECTION_URL_LIST_ITEMS]=""
for RWB_REDIRECTION_URL in $RWB_REDIRECTION_URLS; do
	VARS[RWB_REDIRECTION_URL_LIST_ITEMS]+="<li><a href='$RWB_REDIRECTION_URL'>$RWB_REDIRECTION_URL</a></li>"
done
		
VARS[RWB_EMAIL]="rwb@greatfire.org"

VARS[RWB_JQUERY_URL]="jquery-1.11.1.min.js"
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
			for KEY in "${!VARS[@]}"; do 
				LINE=$(echo "$LINE" | sed "s,{$KEY},${VARS[$KEY]},g")
			done
			echo "$LINE"
		done \
		< $SRC_DIR/$FILE \
		> $DEMO_FILE
		
	else
		cp $SRC_DIR/$FILE $DEMO_FILE
	fi
	
done < <(ls $SRC_DIR)