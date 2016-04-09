@echo off
::svn cleanup %~dp0
SET mypath=%~dp0
svn cleanup %mypath:~0,-4%
::svn cleanup
exit