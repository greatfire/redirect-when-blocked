#!/bin/bash
SRC_DIR="src"
DEMO_DIR="demo"
REDIRECTION_URL="https://github.com/greatfire/wiki"

while read FILE; do
	cat $SRC_DIR/$FILE | sed "s,{REDIRECTION_URL},$REDIRECTION_URL,g" > $DEMO_DIR/$FILE
done < <(ls $SRC_DIR)