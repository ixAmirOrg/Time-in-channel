<?php
/*
  _          _              _       ___            
 (_)_  __   / \   _ __ ___ (_)_ __ / _ \ _ __ __ _ 
 | \ \/ /  / _ \ | '_ ` _ \| | '__| | | | '__/ _` |
 | |>  <  / ___ \| | | | | | | |  | |_| | | | (_| |
 |_/_/\_\/_/   \_\_| |_| |_|_|_|   \___/|_|  \__, |
                                             |___/  on GitHub : https://github.com/ixAmirOrg 
*/
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
include('jdf.php');
define('TOKEN','12345:Abcd'); // Your Bot Token
$channel = '@'; // Your Channel ID
//===[Required functions]===//
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".TOKEN."/".$method;
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
//=====Variables=====//
$update = json_decode(file_get_contents('php://input'));
if(isset($update->channel_post->new_chat_title)){
bot('deleteMessage',[
'chat_id'=>$update->channel_post->chat->id,
'message_id'=>$update->channel_post->message_id
]);
exit();
}
$time = str_replace(range(0,9),["𝟎","𝟏","𝟐","𝟑","𝟒","𝟓","𝟔","𝟕","𝟖","𝟗"],jdate("H:i"));
$date = str_replace(range(0,9),["𝟎","𝟏","𝟐","𝟑","𝟒","𝟓","𝟔","𝟕","𝟖","𝟗"],jdate("Y/m/d"));
$random = ["😂","😐","😁","😘","❤️","😍","😞","🌹","😆","😀","😕","😇","🙃","🙂","‌🥲","😎","🧐","🤪","🤩","🥳","🙁","🤯","😶","😴"];
$emoji = $random[array_rand($random)];
bot('setChatDescription',[
'chat_id'=>$channel,
'description'=>"
• Tʜᴇ Oʀɢɪɴᴀʟ Cʜᴀɴɴᴇʟ Oғ AᴍɪʀAʟɪ Zᴀᴍᴀɴɪ •

❤️• ɪᴛ ᴀʟʟ sᴛᴀʀᴛᴇᴅ ғʀᴏᴍ ᴢᴇʀᴏ !

🇮🇷 • Sᴜʙᴊᴇᴄᴛ Tᴏ Tʜᴇ Lᴀᴡs Oғ Tʜᴇ Isʟᴀᴍɪᴄ Rᴇᴘᴜʙʟɪᴄ Oғ ɪʀᴀɴ !

⌚️ • I.R Time : $time
📆 • I.R Date : $date
"]); //Channel Description
?>
