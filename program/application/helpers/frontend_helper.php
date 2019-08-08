<?php
/*
 * @Link Untuk URL pada Frontend
 */
if(!function_exists("web_url"))
{
    function web_url()
    {
        return base_url().link_index();
    }
}

/*
 * @Menambahkan index.php jika htaccess tidak berjalan
 */
if(!function_exists("link_index"))
{
    function link_index()
    {
        if(xml('allow_htaccess'))
            return '';
        else
            return 'index.php/';
    }
}

if(!function_exists("url_client"))
{
    function url_client()
    {
        if(xml('is_preview'))
            return xml('url_preview');
        else
            return base_url()."clients/";
    }
}

if(!function_exists("dir_client"))
{
    function dir_client()
    {
        if(xml('is_preview'))
            return xml('dir_preview');
        else
            return  xml('dir_client');
    }
}

/*
 * @Age
 */
if(!function_exists("age"))
{
    function age($birthDate)
    {
        //explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));

        return $age;
    }
}

/*
 * @Url Youtube
 */
if(!function_exists("parse_url_youtube"))
{
    function parse_url_youtube($url,$key)
    {
        //$url = 'http://www.youtube.com/watch?v=Z29MkJdMKqs&feature=grec_index';

        // break the URL into its components
        $parts = parse_url($url);

        // $parts['query'] contains the query string: 'v=Z29MkJdMKqs&feature=grec_index'

        // parse variables into key=>value array
        $query = array();
        parse_str($parts['query'], $query);

        //echo $query['v']; // Z29MkJdMKqs
        //echo $query['feature'] ;// grec_index

        return $query[$key];
    }
}

/*
 * @Date format UTC
 */
if(!function_exists("date_now"))
{
    function date_now($time=false)
    {
        date_default_timezone_set('UTC');
        if($time){
            return date('Y-m-d H:i:s');
        }else {
           return date('Y-m-d');
        }
    }
}

/*
 * @Format date
 */
if(!function_exists("format_date"))
{
    function format_date($date,$format = 'F d, Y')
    {
        $return = '';
        if(!empty($date)){
            $date = new DateTime($date);
            $return .=$date->format($format);
        }
        return $return;
    }
}

/*
 * @Format date Indonesia
 */
if(!function_exists("format_date_ID"))
{
    function format_date_ID($date = null)
    {
        $curentdate = date('Y',time()) ."-". date('m',time())."-". date('d',time());
        $date = empty($date) ? $curentdate : $date;

        $date = new DateTime($date);

        $day = $date->format("j");
        $month = $date->format("n");
        $year = $date->format("Y");

        $days = date("w",mktime(0,0,0,$month,$day,$year));

        $out = DayID($days).', ';
        $out .= $day.' ';
        $out .= MonthID($month).' ';
        $out .= $year.' ';

        return $out;
    }

    function DayID($day = 0)
    {
        $strDay = "";
        switch($day){
                case 0:$strDay = "Minggu";break;
                case 1:$strDay = "Senin";break;
                case 2:$strDay = "Selasa";break;
                case 3:$strDay = "Rabu";break;
                case 4:$strDay = "Kamis";break;
                case 5:$strDay = "Jumat";break;
                case 6:$strDay = "Sabtu";break;
        };

        return $strDay;
    }

    function MonthID($m = 0)
    {
        $strMonth = "";
        switch($m){
                case 1:$strMonth = "Januari";break;
                case 2:$strMonth = "Februari";break;
                case 3:$strMonth = "Maret";break;
                case 4:$strMonth = "April";break;
                case 5:$strMonth = "Mei";break;
                case 6:$strMonth = "Juni";break;
                case 7:$strMonth = "Juli";break;
                case 8:$strMonth = "Agustus";break;
                case 9:$strMonth = "September";break;
                case 10:$strMonth = "Oktober";break;
                case 11:$strMonth = "November";break;
                case 12:$strMonth = "Desember";break;
        };

        return $strMonth;
    }
}


/*
 * @Config Setting
 */
if(!function_exists("xml"))
{
    function xml($id = '')
    {
    	$CI =& get_instance();

        return $CI->config->item($id);
    }
}


if(!function_exists('language'))
{
    function language()
    {
        $CI =& get_instance();
        $language = $CI->session->userdata('language');

        return $v = isset($language) ? $language : "bahasa";
    }
}

if(!function_exists('lang_flex'))
{
    function lang_flex()
    {
        return $v = ((language() == '') OR (language()=='bahasa')) ? "" : "_en";
    }
}

if(!function_exists("get_tag_p"))
{
    function get_tag_p($html = '',$index=false)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $domx = new DOMXPath($dom);
        $entries = $domx->evaluate("//p");
        $arr = array();
        foreach ($entries as $entry) {
         if(!empty($entry->nodeValue) and strlen($entry->nodeValue) > 9)
            $arr[] = '<' . $entry->tagName . '>' . $entry->nodeValue .  '</' . $entry->tagName . '>';
        }

        if($index)
            return $data = isset($arr[$index-1]) ? $arr[$index-1] : '';
        else
            return $arr;
    }
}


if(!function_exists("get_email_contact_us"))
{
    function get_email_contact_us()
    {
    	$CI =& get_instance();
        $CI->load->model('email_mod');

        $value = $CI->email_mod->get_email();
        return $value;
    }
}


if(!function_exists("get_categories_by_id"))
{
    function get_categories_by_id($id)
    {
    	$CI =& get_instance();
        $CI->load->model('services_mod');

        $value = $CI->services_mod->get_categories_services_by_id($id);
        return $value;
    }
}
