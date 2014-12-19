<?
class Google_translate_api
{
 public  $out = "";
        public  $text = "";
       public $opts = array("text" => "", "language_pair" => "");
        function setValues($text,$fromLanguage,$toLanguage)
       {
         if($text != "")
           $this->opts["text"] = $text;
              if($fromLanguage != "" && $toLanguage != "")
              $this->opts["language_pair"] = $fromLanguage."|".$toLanguage;
     }
 function translate()
      {
         $this->out = "";
          if (strlen($this->opts['text']) >  500)
           {
                 $str1 = cSubStr($this->opts['text'],0,480);
                       $str2 = cSubStr($this->opts['text'],480,(strlen($this->opts['text']-480)));
                       $google_translator_url1 = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($str1)."&langpair=".urlencode($this->opts['language_pair'])."";
                        $google_translator_url2 = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($str2)."&langpair=".urlencode($this->opts['language_pair'])."";
                        $response1 = $this->postPage(array("url" => $google_translator_url1));
                    $response2 = $this->postPage(array("url" => $google_translator_url2));
                    $resValues = $response1['responseData']['translatedText'].$response2['responseData']['translatedText'];
           }
         else
              {
                 $google_translator_url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($this->opts['text'])."&langpair=".urlencode($this->opts['language_pair'])."";
 
                    $response = $this->postPage(array("url" => $google_translator_url));
                      $resValues = $response['responseData']['translatedText'];
         }
 
          $this->out = $resValues;
 
           return $this->out;
        }
 function postPage($opts)
  {
         $response = "";
           if($opts["url"] != "") {
                  $ch = curl_init($opts["url"]);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                   $response = curl_exec($ch);
                       if(curl_errno($ch))
                       $response = "";
                   curl_close($ch);
                  $decoded = json_decode( $response, true );
                }
         return $decoded;
  }
}
 
?>