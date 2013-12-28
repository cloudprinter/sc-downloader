<?php
/**
	Resolve soundcloud URL to its track-ID
**/
function resolve_link($link)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.soundcloud.com/resolve?url=".$link."&_status_format=json&client_id=b45b1aa10f1ac2941910a7f0d10f8e28&app_version=5367f3cb");
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER,true); //Optional response headers display
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: api.soundcloud.com","Origin: https://soundcloud.com","Referer: ".$link));
	$result = curl_exec($ch);
	preg_match("/tracks\/(\d+)\?/",$result,$trackid);
	return $trackid[1];
}
/**
	Get goo.gl short link
	https://developers.google.com/url-shortener/v1/getting_started
**/
function shorten_link($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/urlshortener/v1/url");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("longUrl"=>$url)));
	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$urls = json_decode($result);
	return $urls->id;
}	
?>