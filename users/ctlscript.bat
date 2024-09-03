@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist C:\Users\Anne Wanjiku\Downloads\Final project T\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\server\hsql-sample-database\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\ingres\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\ingres\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\mysql\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\mysql\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\postgresql\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\apache\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\apache\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\openoffice\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\apache-tomcat\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\apache-tomcat\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\resin\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\resin\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\jetty\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\jetty\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\subversion\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\lucene\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\lucene\scripts\ctl.bat START)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\third_application\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\third_application\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\third_application\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\lucene\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\subversion\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\subversion\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\jetty\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\jetty\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\resin\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\resin\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT C:\Users\Anne Wanjiku\Downloads\Final project T\apache-tomcat\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\openoffice\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\apache\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\apache\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\ingres\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\ingres\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\mysql\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\mysql\scripts\ctl.bat STOP)
if exist C:\Users\Anne Wanjiku\Downloads\Final project T\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\Anne Wanjiku\Downloads\Final project T\postgresql\scripts\ctl.bat STOP)

:end

