<?php

namespace App\Package;

class SendSMSLib
{
	var $userAccount = "966597424440";
	var $passAccount = "mobily@12";
	var $sender = "Erjaan";

	//Results of Send SMS API, in text format
    var $arraySendMsg = array();

    function __construct(){
    	if(empty($this->this->arraySendMsg)){
    		$this->setResponseText();
    	}
    }

    function setResponseText()
    {
        $this->arraySendMsg[0] = "Connection failed to Mobily.ws server";
		$this->arraySendMsg[1] = "SMS message sent successfully";
		$this->arraySendMsg[2] = "Your balance is 0";
		$this->arraySendMsg[3] = "Your balance is not enough";
		$this->arraySendMsg[4] = "Your mobile number (userName) is Invalid";
		$this->arraySendMsg[5] = "Your Password is incorrect";
		$this->arraySendMsg[6] = "Sms send operation failed, try again later";
		$this->arraySendMsg[7] = "The schools system is unavailable";
		$this->arraySendMsg[8] = "Repetition of the school code for the same user";
		$this->arraySendMsg[9] = "Trial version is expired ";
		$this->arraySendMsg[10] = "The count of mobile number does not match the count of messages";
		$this->arraySendMsg[11] = "Your subscription does not allow you to send messages to this school";
		$this->arraySendMsg[12] = "Incorrect portal version";
		$this->arraySendMsg[13] = "Your number does not active or the (BS) symbol is missing in the end of the message";
		$this->arraySendMsg[14] = "Sender Name not accepted, or you not authorized to perform this action";
		$this->arraySendMsg[15] = "Number(s) is empty or incorrect";
		$this->arraySendMsg[16] = "Sender Name is empty or invalid";
		$this->arraySendMsg[17] = "Incorrect message encode";
		$this->arraySendMsg[18] = "Sending stoped from the provider";
		$this->arraySendMsg[19] = "No applicationType";            
    }

    //Send SMS API using CURL method
    function sendSMS($body)
    {
//         echo '<pre>';
//        print_r($body);die;
        
    	if(!empty($body['userAccount'])){
    		$this->userAccount = $body['userAccount'];
    	}

    	if(!empty($body['passAccount'])){
    		$this->passAccount = $body['passAccount'];
    	}

        $url = "http://www.mobily.ws/api/msgSend.php";
//        $url = "http://www.mobily.ws/api/msgSendWK.php";
//        
        $stringToPost = "mobile=".$this->userAccount."&password=".$this->passAccount."&numbers=".$body['numbers']."&sender=".urlencode($body['sender'])."&msg=".$body['msg']."&timeSend=".$body['timeSend']."&dateSend=".$body['dateSend']."&applicationType=".$body['applicationType']."&domainName=".$body['domainName']."&msgId=".$body['MsgID']."&deleteKey=".$body['deleteKey']."&lang=3&notRepeat=1";
        
        
//        $url = "http://www.mobily.ws/api/msgSendWK.php?mobile=966597424440&password=mobily@12&numbers=918103172052&sender=NEWSMS&msg=06270647064406270020064806330647064406270020062806430020064506390020006D006F00620069006C0079002E00770073&timeSend=0&dateSend=0&deleteKey=45871&msgId=15174&applicationType=68&domainName=ss.erjaan.com&notRepeat=1";
//        $d = file_get_contents($url);
        
       

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $result = curl_exec($ch);
        return $this->arraySendMsg[$result];
        
    }
    
    //Send Formatted SMS, using CURL
//function sendSMSWK($userAccount, $passAccount, $numbers, $sender, $msg, $msgKey, $MsgID, $timeSend=0, $dateSend=0, $deleteKey=0, $viewResult=1)
function sendSMSWK($body){
    
//        $url = "http://www.mobily.ws/api/msgSendWK.php?mobile=966597424440&password=mobily@12&numbers=917089306333&sender=NEWSMS&msg=Hi I am here&timeSend=0&dateSend=0&deleteKey=45871&msgId=15174&applicationType=68&domainName=ss.erjaan.com&notRepeat=1";
//        $d = file_get_contents($url);
//        echo '<pre>';
//        print_r($d);die;
    
        $viewResult=1;
	//global $arraySendMsgWK;
	$url = "http://www.mobily.ws/api/msgSendWK.php";
	$applicationType = "68";
	$sender = urlencode($body['sender']);
	$domainName = $_SERVER['SERVER_NAME'];
        
        if(!empty($body['userAccount'])){
    		$this->userAccount = $body['userAccount'];
    	}

    	if(!empty($body['passAccount'])){
    		$this->passAccount = $body['passAccount'];
    	}
        
//    if(!empty($body['userAccount']) && empty($body['passAccount'])) {
        $stringToPost = "apiKey=".$this->userAccount."&numbers=".$body['numbers']."&sender=".$sender."&msg=".$body['msg']."&msgKey=".$body['msgKey']."&timeSend=".$body['timeSend']."&dateSend=".$body['dateSend']."&applicationType=".$body['applicationType']."&domainName=".$body['domainName']."&msgId=".$body['MsgID']."&deleteKey=".$body['deleteKey']."&lang=3";
//    } 
//    else {
//        $stringToPost = "mobile=".$userAccount."&password=".$passAccount."&numbers=".$numbers."&sender=".$sender."&msg=".$msg."&msgKey=".$msgKey."&timeSend=".$timeSend."&dateSend=".$dateSend."&applicationType=".$applicationType."&domainName=".$domainName."&msgId=".$MsgID."&deleteKey=".$deleteKey."&lang=3";
//    }
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
	$result = curl_exec($ch);
        return $this->arraySendMsg[$result];

//	if($viewResult)
//		$result = printStringResult(trim($result) , $arraySendMsgWK);
//	return $result;
}


    //Check SMS Balence API using CURL method
    function checkSmsBalence($body)
    {
        if(!empty($body['userAccount'])){
            $this->userAccount = $body['userAccount'];
        }

        if(!empty($body['passAccount'])){
            $this->passAccount = $body['passAccount'];
        }

        $url = "www.mobily.ws/api/balance.php";
        
        $stringToPost = "mobile=".$this->userAccount."&password=".$this->passAccount;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $sms_balence = curl_exec($ch);
        
        return $sms_balence;
    }//END checkSmsBalence();


}
