@echo off
echo Scss2css - Windows
sass --no-cache --watch "%CD%\scss:%CD%\css" --style compact