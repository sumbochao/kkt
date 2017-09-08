#!/bin/bash
FILES=/data/website/taoviec/taoviec.com/java_cront/app/DUMPFILES/*.txt
for f in $FILES
do
	echo "Processing $f file..."
	#read all line from file
	while read -r line
		do
			# display line or do somthing on $line
			command | grep $line
	done < "$f"
	# take action on each file. $f store current file name
	# delete file
	#rm $f
done