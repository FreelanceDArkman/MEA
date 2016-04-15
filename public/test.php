<?php
//echo 'hello darkman';
//var_dump(exec("/backend/md5/md5.bat -e test"));
//system("cmd /c C:[/backend/md5/md5.bat]");
//var_dump(exec("\\c:\\md5\\md5.bat -e test"));
//exec("\\c:\\md5\\md5.bat -e test", $output);
//var_dump($output);
//
//$test=shell_exec("C:\\windows\\system32\\cmd.exe /c md5\\md5.bat");
//http://192.168.1.35/
//var_dump(exec('\\192.168.1.35\C:\WINDOWS\system32\cmd.exe /c START C:\md5\md5.bat'));
//echo exec('\\192.168.1.35\c:\\md5\\md5.bat', $output);
//exec('c:\md5\Readme.txt', $output);
//echo  system('c:\md5\Readme.txt');
//echo exec("md5.bat");

//var_dump($output);

$output = shell_exec("./backend/md5/md5.sh -e ss 2>&1");
////echo passthru("md5.bat");
var_dump($output);
?>