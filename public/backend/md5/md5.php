<?php
$data = "asdasdas";
echo passthru("cmd /c md5.bat -e ".$data." 2>&1");


function MeAEncrypt($data){
    return passthru("cmd /c /md5.bat -e ".$data." 2>&1");
    //return "hellosss";
}
//$data = $_GET['data'];

//echo passthru("cmd /c /md5.bat -e asdadasd 2>&1");
// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
//echo passthru("cmd /c C:[\\md5\\md5.bat] -e ts");

//$test=shell_exec("C:\\windows\\system32\\cmd.exe /c md5\\md5.bat -e test");
//$test=shell_exec("C:\\windows\\system32\\cmd.exe /c md5.bat -e ttt");
//$test = shell_exec('ls -lart');
//phpinfo();
//$output = shell_exec("dir");
//$output = exec("dir");
//$output = shell_exec("./md5.sh -e ss 2>&1");
////echo passthru("md5.bat");
//var_dump($output);

// Printing additional info
//echo '
//</pre>
//<hr />Last line of the output: ' . $last_line . '
//<hr />Return value: ' . $retval;

//$out = array();
////exec('cmd /c svn update --config-dir C:\Users\Administrator\AppData\Roaming\Subversion dir 2>&1',$out,$exitcode);
//exec('cmd /c dir 2>&1',$out,$exitcode);
//echo "<br />EXEC: ( exitcode : $exitcode )";
//echo "<hr /><pre>";
//print_r($out);
//echo "</pre>";
