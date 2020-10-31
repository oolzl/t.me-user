<?php
// BY BRoK - @x_BRK - @i_BRK //
$TT = file_get_contents("token.txt");
define('API_KEY',$TT);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
if (!file_exists('madeline.php')) {
 copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';  
$settings['app_info']['api_id'] = 203088;  
$settings['app_info']['api_hash'] = 'f360233d3627586775bd7298ee775bd1';  
$MadelineProto = new \danog\MadelineProto\API('s.madeline', $settings); 
$MadelineProto->start(); 
$admin = file_get_contents("id.txt");
$sudo = $admin;
$date_start = date("m/d h:i:s");
date_default_timezone_set('Asia/Baghdad');
$x = 1;
$l = 1000000;
$m = "/root/"; 
$i = 0; 
$a = 0; 
$start = time();
$time = date('h:i:s');
$date = date('20y/m/d');
do{
try{
if(file_get_contents("run") == "yes"){
try{
$u = explode("\n",file_get_contents("users")); 
for($i=0; $i<count($u); $i++){ 
$user = $u[$i];
if($u[$i] != ""){
$MadelineProto->messages->getPeerDialogs(['peers'=> [$u[$i]]]);
}
echo '@'.$user." - ".$x." - ".date('i:s')."\n"; 
}
$a++; 
$x++;
file_put_contents("u.txt",$user); 
file_put_contents("l.txt",$x); 
}catch(Exception $e){
$type = file_get_contents("type");
if($type != 'Update ID'){
if($type == 'Channel'){
$updates = $MadelineProto->channels->createChannel(['broadcast' => true, 'megagroup' => false, 'title' => "BRoK", 'about' => "@i_BRK",]);
$MadelineProto->channels->updateUsername(['channel' => $updates['updates'][1], 'username' => $user, ]);
$MadelineProto->messages->sendMessage(['peer' => $updates['updates'][1], 'message' => "
- Done BY => @i_BRK"]);
}elseif($type == "Account"){
$MadelineProto->account->updateUsername(['username' => $user]);
}
}
echo "New UserName: @$user \n";
$end = time() - $start;
$date_end = date("m/d h:i:s");
bot("sendmessage",[
'chat_id' => $admin,
'text' => "- Done Changed The username
- New User => @$user
- Moved To => $type
- Loops => $x
- - - - - - - - - 
- Change Time => $date_end
- Start Time => $date_start
- - - - - - - - - 
- BY BRoK - @i_BRK",]);
file_put_contents("run","no");
exit;
}
}
}catch(Exception $e){
bot("sendmessage",[
'chat_id' => $admin,
'text' => $e->getMessage() ." :  @".$u[$i]
]);
echo $e->getMessage()."\n";
file_put_contents("run","no");
exit;
}
}while(true);