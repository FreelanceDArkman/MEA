@echo off
rem c:\inetpub\wwwroot\public\tools\xls2txt\xls2txt.exe c:\inetpub\wwwroot\public\inbox\employee\data.xls c:\inetpub\wwwroot\public\inbox\employee\1234.txt 1234
c:\inetpub\wwwroot\public\tools\xls2txt\xls2txt.exe %1 %2 %3
set dest=c:\lam
xcopy %2 %dest% /E /d /y

