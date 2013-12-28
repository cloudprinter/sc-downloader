<?php
header("Content-type: text/plain");
/**
	Extract link to mp3 
**/
require_once('functions.php');
$link = $_POST['link'];

$id = resolve_link($link);
/** cURL request to extract link **/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.soundcloud.com/i1/tracks/".$id."/streams?client_id=b45b1aa10f1ac2941910a7f0d10f8e28&app_version=5367f3cb");
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER,true); //Optional response headers display
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: api.soundcloud.com","Origin: https://soundcloud.com","Referer: ".$link));
$result = curl_exec($ch);
preg_match("/https\:(.*?)\"/",$result,$mlink);
$shortlink = shorten_link(trim($mlink[0],'"'));
if($mlink[1])
{
	$history = file_get_contents("history.json");
	$arr = json_decode($history);
	$arr[] = array("name"=>basename($link),"link"=>$shortlink);
	file_put_contents("history.json",json_encode($arr));
	echo json_encode(array("status"=>"0","name"=>basename($link),"link"=>$shortlink));
}
else
{
	echo json_encode(array("status"=>"1","message"=>"Error! Please check the link entered"));
}
?>