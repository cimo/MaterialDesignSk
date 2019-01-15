#!/bin/bash
clear
echo Uglifyjs - Mac
SOURCE=$(dirname ${BASH_SOURCE[0]})
find "$SOURCE"/javascript/system/ -name "*.min.js" -delete
for f in "$SOURCE"/javascript/system/*.js;
    do uglifyjs $f --compress --mangle --output $f.min.js
done