<?php 
//Check if sms notification is enabled
if(isset($configInfo['sms_note']) 
    AND $configInfo['sms_note'] == 'Enabled'){

    $newPhone = $newPhone = str_replace('+', '', $uInfo['phone']);
    $SMSsender = $configInfo['sms_sender'];
    $SMSport = $configInfo['sms_port'];
    $SMSurl = $configInfo['sms_gateway_url'];
    $SMSusername = $configInfo['sms_gateway_user'];
    $SMSpassword = $configInfo['sms_gateway_pass'];
    $SMSsitename = $siteInfo['site_name'];
    $firstName = $uInfo['first_name'];
    
    class Sender {
        var $host;
        var $port;
        var $strUserName;
        var $strPassword;
        var $strSender;
        var $strMessage;
        var $strMobile;
        var $strMessageType;
        var $strDlr;
        var $phoneCode;
        var $newPhone;
        var $SMSsender;
        var $SMSport;
        var $SMSusername;
        var $SMSpassword;
        var $SMSsitename;
        var $firstName;
        var $senderName;
        
        private function sms__unicode($message) {
            $hex1 = '';
            if (function_exists('iconv')) {
                $latin = @iconv('UTF-8', 'ISO-8859-1', $message);
                if (strcmp($latin, $message)) {
                    $arr = unpack('H*hex', @iconv('UTF-8', 'UCS-2BE', $message));
                    $hex1 = strtoupper($arr['hex']);
                }
                if ($hex1 == '') {
                    $hex2 = '';
                    $hex = '';
                    for ($i = 0; $i < strlen($message); $i++) {
                        $hex = dechex(ord($message[$i]));
                        $len = strlen($hex);
                        $add = 4 - $len;
                        if ($len < 4) {
                            for ($j = 0; $j < $add; $j++) {
                                $hex = "0" . $hex;
                            }
                        }
                        $hex2.=$hex;
                    }
                    return $hex2;
                } else {
                    return $hex1;
                }
            } else {
                print 'iconv Function Not Exists !';
            }
        }

        //Constructor.. 
        public function Sender($host, $port, $username, $password, $sender, $message, $mobile, $msgtype, $dlr) {
            global $phoneCode;
            global $newPhone;
            global $SMSsender;
            global $SMSport;
            global $SMSurl;
            global $SMSusername;
            global $SMSpassword;
            global $SMSsitename;
            global $firstName;
            $this->host = $SMSurl;
            $this->port = $SMSport;
            $this->strUserName = $SMSusername;
            $this->strPassword = $SMSpassword;
            $this->strSender = $SMSsender;
            $this->strMessage = "Hi ".$firstName.", Your account has been permanently restricted for violation of our Terms in ".$SMSsitename." community.";
            $this->strMobile = $newPhone;
            $this->strMessageType = 0;
            $this->strDlr = 0;
        }

        public function Submit() {
            $port = "";
            if($this->port == '') {
                $port = ":" . $this->port;
            }
            if ($this->strMessageType == "2" || $this->strMessageType == "6") {
                //Call The Function Of String To HEX. 
                $this->strMessage = $this->sms__unicode($this->strMessage);
                try {
                    //Smpp http Url to send sms.
                    $live_url = "http://" . $this->host . ":" . $this->port . "/bulksms/bulksms?username=" . $this->strUserName . "&password=" . $this->strPassword . "&type=" . $this->strMessageType . "&dlr=" . $this->strDlr . "&destination=" . $this->strMobile . "&source=" . $this->strSender . "&message=" . $this->strMessage . "";
                    $parse_url = file($live_url);
                    echo $parse_url[0];
                } catch (Exception $e) {
                    echo 'Message:' . $e->getMessage();
                }
            } else {
                $this->strMessage = urlencode($this->strMessage);
                try {
                    //Smpp http Url to send sms.
                    $live_url = "http://" . $this->host . $port . "/bulksms/bulksms?username=" . $this->strUserName . "&password=" . $this->strPassword . "&type=" . $this->strMessageType . "&dlr=" . $this->strDlr . "&destination=" . $this->strMobile . "&source=" . $this->strSender . "&message=" . $this->strMessage . "";
                    $parse_url = file($live_url);
                    //echo $parse_url[0];
                } catch (Exception $e) {
                    echo 'Message:' . $e->getMessage();
                }
            }
        }
    } 

    //Call The Constructor. 
    $obj = new Sender("IP/DOMAIN","PORT","USERNAME","PASSWORD","SENDER/SOURCE","MESSAGE","DESTINATION","MESSAGE TYPE","1");
    $obj->Submit ();
}
?>