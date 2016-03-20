@echo off
set CSADAPTER_HOME=%cd%
set CSADAPTER_LIB=%CSADAPTER_HOME%\lib
set JARS=
set CLASSPATH=

for %%i in (%CSADAPTER_LIB%\*.jar) do call cpappend.bat %%i
set CLASSPATH=%CSADAPTER_HOME%\bin;%JARS%;
java tools.util.MD5 %1 %2
@echo on


