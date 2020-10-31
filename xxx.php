<?php
// BY BRoK - @x_BRK - @i_BRK //
$m = "/root/";
require('conf.php');
if (!file_exists("token.txt")) {
$token =  readline("- Enter Token : ");
file_put_contents("token.txt", $token);
if (!file_exists("id.txt")) {
$id = readline("- Enter iD : ");
file_put_contents("id.txt", $id);
}
}
$TT = file_get_contents("token.txt");
$II = file_get_contents("id.txt");
$tg = new Telegram($TT);
$lastupdid = 1;
while(true){
 $upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]);
 if(isset($upd['result'][0])){
  $text = $upd['result'][0]['message']['text'];
  $chat_id = $upd['result'][0]['message']['chat']['id'];
$from_id = $upd['result'][0]['message']['from']['id'];
$username = $upd['result'][0]['message']['from']['username'];
$sudo = $II;
if($from_id == $sudo){ 
if($text == '/start'){ 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"~ Hi in BRoK Checker This is Your Orders
- - - - - - - - -
- /Fuck => Start The Checker
- /stop => Stop The Checker
- - - - - - - - -
- /add1 + @User => Add The First User To The List
- /add + @User => Add Users Yo The List
- /Delet + @User => Remove User From List
- /List => Show The List of Users
- /Clear => Delet All Users From The List
- - - - - - - - -
- /setChannel => Set The Move To Channel
- /setAccount => Set The Move To Account    
- - - - - - - - -
- /Number => Login New Account To Checker
- /BRoK => Show Checker Status
- - - - - - - - -
- BY [ @x_BRK - @i_BRK ]
"
]); 
} 
if(preg_match('/add1 @/', $text )) { 
$ex = explode('/add1 @',$text)[1]; 
file_put_contents("users",$ex); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- Done Add @$ex The First User To List", 
]); 
} 
if(preg_match('/add @/', $text )) { 
$ex = explode('/add @',$text)[1]; 
file_put_contents("users","\n$ex",FILE_APPEND); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- Done Add @$ex To List", 
]); 
} 
if($text == '/setChannel'){ 
file_put_contents("type","Channel"); 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Set Move To Channel", 
]); 
} 
if($text == '/setAccount'){ 
file_put_contents("type","Account"); 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Set Move To Account", 
]); 
} 
$se = explode("\n", file_get_contents('users'));
$u = "";
if($text == "/List"){
for($i=0; $i<count($se); $i++){
$n1 = $i + 1;
$u .= $n1."- @".$se[$i]."\n";
}
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- The Users in The List\n- - - - -\n
$u ",
]);
}
$BRoKyes = file_get_contents("run");
if($BRoKyes == 'yes'){
    $BRoKSta = "Running";
}elseif($BRoKyes == 'no'){
    $BRoKSta = "Sleeping";
}
if($text  == "/BRoK"){ 
$loop = file_get_contents("l.txt"); 
$us = file_get_contents("u.txt"); 
$type = file_get_contents("type");
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- The Checker is => $BRoKSta
- Move To => $type
- UserName => @$us
- Loops => $loop
", 
]); 
}
if(preg_match('/(Delet) @/', $text )) { 
$ex = explode('/Delet @',$text); 
$user = file_get_contents("users"); 
$s = str_replace(" ","\n",$ex[1]); 
$se = str_replace($s."\n","",$user); 
file_put_contents("users",$se); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- Done Remove @$ex[1] From The List", 
]); 
} 
if($text == '/Clear'){ 
file_put_contents("users",""); 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Remove All users From The List", 
]); 
} 
if($text == '/Fuck'){
file_put_contents("run","yes");
shell_exec('screen -dmS checker php checker.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- Done Run The Checker
- To Show Status Send /BRoK",
]);
}
if($text == '/stop'){
  shell_exec('screen -S checker -X kill'); 
file_put_contents("run" , "no");
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- Done Stop The Checker", 
]);
}
if($text == '/Number'){
	system('rm -rf *m*');
file_put_contents("step","");
if(file_get_contents("step") == ""){
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- Send The Number 
- EX : +964**********",
]);
file_put_contents("step","2");
  system('php g.php');

}
}
} 
$lastupdid = $upd['result'][0]['update_id'] + 1; 
} 
}