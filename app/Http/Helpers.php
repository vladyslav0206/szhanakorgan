<?php

namespace App\Http;
use App\Models\Info;
use App\Models\Page;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Mockery\Exception;
use Auth;
use URL;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class Helpers {

    public static function getConvertToQazLatin($text)
    {
        $cyr2lat_replacements = array (
            "А" => "A","Ә" => "A'", "Б" => "B","В" => "V","Г" => "G","Ғ" => "G'","Д" => "D",
            "Е" => "E","Ё" => "E","Ж" => "J","З" => "Z","И" => "I'","І" => "I",
            "Й" => "I'","К" => "K","Қ" => "Q","Һ" => "H","Л" => "L","М" => "M","Н" => "N","Ң" => "N'",
            "О" => "O","Ө" => "O'","П" => "P","Р" => "R","С" => "S","Т" => "T",
            "У" => "Y'","Ұ" => "U","Ү" => "U'","Ф" => "F","Х" => "H","Ц" => "Ts","Ч" => "C'",
            "Ш" => "S'","Щ" => "S'","Ъ" => "","Ы" => "Y","Ь" => "",
            "Э" => "E","Ю" => "Yu","Я" => "Ya",
            "а" => "a","ә" => "a'","б" => "b","в" => "v","г" => "g","ғ" => "g'","д" => "d",
            "е" => "e","ё" => "e","ж" => "j","з" => "z","и" => "i'","і" => "i",
            "й" => "i'","к" => "k","қ" => "q","һ" => "h","л" => "l","м" => "m","н" => "n","ң" => "n'",
            "о" => "o","ө" => "o'","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "y'","ұ" => "u","ү" => "u'","ф" => "f","х" => "h","ц" => "ts","ч" => "c'",
            "ш" => "s'","щ" => "s'","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
        );

        $str = strtr($text,$cyr2lat_replacements);

        return $str;
    }

    public static function getTranslatedSlugRu($text)
    {
        $cyr2lat_replacements = array (
            "А" => "a","Ә" => "a", "Б" => "b","В" => "v","Г" => "g","Ғ" => "gh","Д" => "d",
            "Е" => "e","Ё" => "yo","Ж" => "zh","З" => "z","И" => "i","І" => "i",
            "Й" => "y","К" => "k","Қ" => "q","Һ" => "q","Л" => "l","М" => "m","Н" => "n","Ң" => "nh",
            "О" => "o","Ө" => "o","П" => "p","Р" => "r","С" => "s","Т" => "t",
            "У" => "u","Ұ" => "u","Ү" => "u","Ф" => "f","Х" => "kh","Ц" => "ts","Ч" => "ch",
            "Ш" => "sh","Щ" => "csh","Ъ" => "","Ы" => "y","Ь" => "",
            "Э" => "e","Ю" => "yu","Я" => "ya","?" => "",

            "а" => "a","ә" => "a","б" => "b","в" => "v","г" => "g","ғ" => "gh","д" => "d",
            "е" => "e","ё" => "yo","ж" => "dg","з" => "z","и" => "i","і" => "i",
            "й" => "y","к" => "k","қ" => "q","һ" => "q","л" => "l","м" => "m","н" => "n","ң" => "nh",
            "о" => "o","ө" => "o","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "u","ұ" => "u","ү" => "u","ф" => "f","х" => "kh","ц" => "ts","ч" => "ch",
            "ш" => "sh","щ" => "sch","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
            "(" => "", ")" => "", "," => "", "." => "", ":" => "-", "'" => "",

            "-" => "-","%" => "-"," " => "-", "+" => "", "®" => "", "«" => "", "»" => "", '"' => "", "`" => "", "&" => "","/" => "-"
        );

        $str = strtr (trim($text),$cyr2lat_replacements);
        $str  = strtolower($str);
        $str  = str_replace('--',"-",$str);
        $str  = str_replace('--',"-",$str);
        $str =  substr($str, 0, 80);

        return $str;
    }
    
    public static function getSessionLang(){
        $lang = 'ru';
        if (isset($_COOKIE['site_lang'])) {
            $lang = $_COOKIE['site_lang'];
        }
        return $lang;
    }

    public static function getIdFromUrl($url){
        $id = strstr($url,'-',true);
        return $id;
    }
    
    public static function send_mime_mail(
        $name_from, // имя отправителя
        $email_from, // email отправителя
        $name_to, // имя получателя
        $email_to, // email получателя
        $data_charset, // кодировка переданных данных
        $send_charset, // кодировка письма
        $subject, // тема письма
        $body // текст письма
    ) 
    {
        $to = Helpers::mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email_to . '>';
        $from = Helpers::mime_header_encode($name_from, $data_charset, $send_charset)
            .' <' . $email_from . '>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: $from\r\n";
        
        return mail($to, $subject, $body, $headers);
    }

    public static function mime_header_encode($str, $data_charset, $send_charset) {
        if($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset, $str);
        }
        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }
    

    public static function replaceGetUrl($param) {
        $parsed = parse_url("http://example?" .http_build_query($_GET));
        $query = '';
        if(isset($parsed['query'])){
            $query = $parsed['query'];
        }

        parse_str($query, $new_url);
        $param = explode(',', $param);
        $new_val = '';

        foreach($param as $key => $value){
            if($key % 2 == 0){
                unset($new_url[$value]);
                $new_val = $value;
            }
            else {
                $new_url[$new_val] = $value;
            }
        }

        $string = http_build_query($new_url);
        return $string;
    }

    public static function getMonthName($number) {
        $lang = App::getLocale();

        if($lang == 'ru'){
            $monthAr = array(
                1 => array('Январь', 'Января'),
                2 => array('Февраль', 'Февраля'),
                3 => array('Март', 'Марта'),
                4 => array('Апрель', 'Апреля'),
                5 => array('Май', 'Мая'),
                6 => array('Июнь', 'Июня'),
                7 => array('Июль', 'Июля'),
                8 => array('Август', 'Августа'),
                9 => array('Сентябрь', 'Сентября'),
                10=> array('Октябрь', 'Октября'),
                11=> array('Ноябрь', 'Ноября'),
                12=> array('Декабрь', 'Декабря')
            );
        }
        else if($lang == 'kz'){
            $monthAr = array(
                1 => array('Қаңтар', 'Қаңтар'),
                2 => array('Ақпан', 'Ақпан'),
                3 => array('Наурыз', 'Наурыз'),
                4 => array('Сәуір', 'Сәуір'),
                5 => array('Мамыр', 'Мамыр'),
                6 => array('Маусым', 'Маусым'),
                7 => array('Шілде', 'Шілде'),
                8 => array('Тамыз', 'Тамыз'),
                9 => array('Қыркүйек', 'Қыркүйек'),
                10=> array('Қазан', 'Қазан'),
                11=> array('Қараша', 'Қараша'),
                12=> array('Желтоқсан', 'Желтоқсан')
            );
        }
        else if($lang == 'qz'){
            $monthAr = array(
                1 => array("Qan'tar", "Qan'tar"),
                2 => array("Aqpan", "Aqpan"),
                3 => array("Nay'ryz", "Nay'ryz"),
                4 => array("Sa'y'ir", "Sa'y'ir"),
                5 => array("Mamyr", "Mamyr"),
                6 => array("May'sym", "May'sym"),
                7 => array("S'ilde", "S'ilde"),
                8 => array("Tamyz", "Tamyz"),
                9 => array("Qyrku'i'ek", "Qyrku'i'ek"),
                10=> array("Qazan", "Qazan"),
                11=> array("Qaras'a", "Qaras'a"),
                12=> array("Jeltoqsan", "Jeltoqsan"),
            );
        }
        else {
            $monthAr = array(
                1 => array('January', 'January'),
                2 => array('February', 'February'),
                3 => array('March', 'March'),
                4 => array('April', 'April'),
                5 => array('May', 'May'),
                6 => array('June', 'June'),
                7 => array('July', 'July'),
                8 => array('August', 'August'),
                9 => array('September', 'September'),
                10=> array('October', 'October'),
                11=> array('November', 'November'),
                12=> array('December', 'December')
            );
        }
        if(!isset($monthAr[(int)$number][1])){
            return '';
        }
        return $monthAr[(int)$number][1];
    }


    public static function getPhoneFormat($phone){

        $phone = str_replace(' ', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);

        $phone = substr($phone,-11);

        return $phone;
    }

    public static function getParamByPosition($params,$param_name) {
        $params = explode('/',$params);
        foreach($params as $key => $value){
            if($key % 2 == 0 && $value == $param_name)
                return isset($params[$key + 1])?$params[$key + 1]:'';
        }
    }

    
    public static function getPageText($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_text_'.App::getLocale()];
    }

    public static function getPageImage($id){
        $page = Page::find($id);
        if($page == null) return '';

        return $page->page_image;
    }

    public static function getPageUrl($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_url'];
    }

    public static function getPageName($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_name_'.App::getLocale()];
    }

    public static function getMoneyRates(){
        $money_rate = null;

        try {
            $url = "http://www.nationalbank.kz/rss/rates_all.xml";
            $dataObj = simplexml_load_file($url);
            $json = json_encode($dataObj);
            $array = json_decode($json,TRUE);

            $money_rate = array();
            if ($dataObj){
                foreach ($array['channel']['item'] as $item){
                    if($item['title'] == 'USD'){
                        $money_rate[0]['title'] = $item['title'];
                        $money_rate[0]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'EUR'){
                        $money_rate[1]['title'] = $item['title'];
                        $money_rate[1]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'RUB'){
                        $money_rate[2]['title'] = $item['title'];
                        $money_rate[2]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'CNY'){
                        $money_rate[3]['title'] = $item['title'];
                        $money_rate[3]['description'] = $item['description'];
                    }
                }
            }
        }
        catch(Exception $e){

        }

        return $money_rate;
    }

    public static function setSessionLang($lang,$request){
        $locale = $request->segment(1);
        $lang_list = ['ru','kz','en','qz'];
        $url_path = $request->fullUrl();
        if (in_array($locale, $lang_list))
        {
            $url_path = str_replace(URL('/').'/'.$locale,URL('/'),$url_path);
        }
        $lang = str_replace(URL('/'),URL('/').'/'.$lang,$url_path);
        return $lang;
    }

    public static function getCurrentDay(){
        $timestamp = strtotime(date("Y-m-d"));
        $day = date("d", $timestamp);
        $month = date("m", $timestamp);
        return $day .' '.Helpers::getMonthName($month);
    }

    public static function getDateFormat($date_param,$is_show_time = true){
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($date_param);
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        $timestamp = strtotime($date_param);
        $time_format = date("H:i", $timestamp);
        $date_format = date("d.m.Y", $timestamp);


        if($difference==0){
            if($is_show_time == false) return Lang::get('app.today');
            return Lang::get('app.today').', '.$time_format;
        }
        else if($difference < -1){
            $month = date("m", $timestamp);
            $day = date("d", $timestamp);
            $year = date("Y", $timestamp);
            return $day .' '.Helpers::getMonthName($month).', '.$year;
        }
        else
            return Lang::get('app.yesterday');
    }

    public static function getWhether($region_id){
        $whether = null;

        try {
            $url = "https://export.yandex.ru/bar/reginfo.xml?region=".$region_id;
            $dataObj = simplexml_load_file($url);
            $json = json_encode($dataObj);
            $array = json_decode($json,TRUE);

            
            if(isset($array['weather']['day']['day_part'][0])){
                if(isset($array['weather']['day']['day_part'][0]['temperature_to']))
                $whether['temperature'] = $array['weather']['day']['day_part'][0]['temperature_to'];
                elseif(isset($array['weather']['day']['day_part'][0]['temperature']))
                $whether['temperature'] = $array['weather']['day']['day_part'][0]['temperature'];
                if(isset($array['weather']['day']['day_part'][0]['image-v2']))
                $whether['image'] = $array['weather']['day']['day_part'][0]['image-v2'];
            }
        }
        catch(Exception $e){

        }

        return $whether;
    }

    public static function getInfoText($id){
        $page = Info::find($id);
        if($page == null) return '';
        $locale = App::getLocale();
        return $page['info_text_'.$locale];
    }

    public static function getInfoPhoneText($id){
        $page = Info::find($id);
        if($page == null) return '';
        $locale = App::getLocale();
        $page['info_text_'.$locale] = str_replace(['(',')','+','-',' '],"",$page['info_text_'.$locale]);
        return $page['info_text_'.$locale];
    }

    public static function getInfoName($id){
        $page = Info::find($id);
        if($page == null) return '';
        $locale = App::getLocale();
        return $page['info_name_'.$locale];
    }



    public static function sendSMS($number,$sms)
    {
        header('Content-type: text/html; charset=utf-8');
        $number = str_replace(['(',')','+','-'],"",$number);
        $number = substr($number, -10);
        $number = '7' .$number;

        $sms = urlencode($sms);

        $message = file_get_contents("http://kazinfoteh.org:9507/api?action=sendmessage&username=&password=&recipient=".$number."&messagetype=SMS:TEXT&originator=BAIBAZAR.COM&messagedata=Vash sms kod - ".$sms,FILE_TEXT);
        $parsed = simplexml_load_string($message);

        if($parsed->data->acceptreport->statuscode == 0) return "success";
        else return "error";
    }
} 