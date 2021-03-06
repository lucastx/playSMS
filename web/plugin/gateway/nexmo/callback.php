<?php

error_reporting(0);

if (! $called_from_hook_call) {
	chdir("../../../");
	include "init.php";
	include $apps_path['libs']."/function.php";
	chdir("plugin/gateway/nexmo/");
	$requests = $_REQUEST;
}

$remote_slid = $requests['messageId'];
$client_ref = $requests['client-ref'];

// delivery receipt
$status = $requests['status'];
if ($remote_slid && $client_ref && $status) {
	$db_query = "
		SELECT local_slid FROM "._DB_PREF_."_gatewayNexmo 
		WHERE local_slid='$client_ref' AND remote_slid='$remote_slid'";
	$db_result = dba_query($db_query);
	$db_row = dba_fetch_array($db_result);
	$smslog_id = $db_row['local_slid'];
	if ($smslog_id) {
		$data = getsmsoutgoing($smslog_id);
		$uid = $data['uid'];
		$p_status = $data['p_status'];
		switch ($status) {
			case "delivered": $p_status = 3; break; // delivered
			case "buffered":
			case "accepted": $p_status = 1; break; // sent
			default:
				$p_status = 2; break; // failed
		}
		logger_print("dlr uid:".$uid." smslog_id:".$smslog_id." message_id:".$remote_slid." status:".$status, 2, "nexmo callback");
		setsmsdeliverystatus($smslog_id,$uid,$p_status);
		ob_end_clean();
		exit();
	}
}

// incoming message
$sms_datetime = urldecode($requests['message-timestamp']);
$sms_sender = $requests['msisdn'];
$message = urldecode($requests['text']);
$sms_receiver = $requests['to'];
if ($remote_slid && $client_ref && $message) {
	logger_print("incoming", 2, "nexmo callback");
	$sms_sender = addslashes($sms_sender);
	$message = addslashes($message);
	setsmsincomingaction($sms_datetime,$sms_sender,$message,$sms_receiver);
}

?>