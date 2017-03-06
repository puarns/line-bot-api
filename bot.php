<?php
include ('line-bot-api/php/line-bot.php');

$channelSecret = 'dca964b72850d1a98104e1ddfd8a34e7';
$access_token  = 'eYrUwuYVBvWMCWaMOgVVpJ+340T6phdQcs/McASQpkttbwakaPsGBuKDiYA5atIRqY559W+yUFkMxeOCtzg4PIf4JFlN+1o7VbSJyj3MwP+SImCrPvSGg59PDz2JTeOx6K+aQvH2Cz3A40CHsbf+hgdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) 
	$message = json_encode($bot->message);
	$returnMessage = $message;
	if($message == 'address') $returnMessage = 'Condo Parkland เพชรเกษม-ท่าพระ ห้อง 1835 ชั้น 18 เลขที่ 99/657 ถนน เพชรเกษม แขวงวัดท่าพระเขตบางกอกใหญ่ กรุงเทพมหานคร 10600';
	
	$url = 'http://linebot.linetor.com/api.php';
	$data = array('mid' => '123', 'message' => $message);
	$content = json_encode($data);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
	//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
	$result = curl_exec($curl);
	$response = json_decode($result, true);
	$returnMessage = $response['msg'];

	$bot->replyMessageNew($bot->replyToken, $returnMessage);

	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}

	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();
}
