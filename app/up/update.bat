@echo off
::svn update %~dp0
SET mypath=%~dp0
svn update %mypath:~0,-4%
::svn update
exit