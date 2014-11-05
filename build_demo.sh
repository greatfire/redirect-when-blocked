#!/bin/bash
SRC_DIR="src"
DEMO_DIR="demo"
RWB_REDIRECTION_URL="https://github.com/greatfire/wiki"

while read FILE; do
	cat $SRC_DIR/$FILE | sed "s,{RWB_REDIRECTION_URL},$RWB_REDIRECTION_URL,g" > $DEMO_DIR/$FILE
done < <(ls $SRC_DIR)