<?php

function setScript($js_folder, $path){
    if (strpos($path, 'full:') !== false) {
        $path = str_replace('full:', '', $path); 
    }else{
        $path = $js_folder.$path.'?v='.time();
    }
    return "<script src='{$path}'></script>";
}

if (!function_exists('key_to_id')) {
    function key_to_id($array) {
        if (empty($array)) {
            return array();
        }
        $new_arr = array();
        foreach ($array as $id => &$node) {
            $new_arr[$node['id']] =& $node;
        }
        return $new_arr;
    }
}

function getIp(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}

function replaceSpaces($str)
{
    return str_replace(' ', '', $str);
}
 

function savePercent($retail, $price)
{
    return percentFormat(100 - (($price/100)*$retail));
}

function withdrawFee($price, $percent)
{
    if(empty($percent)) return $price;
    return $price - (($percent/100)*$price);
}

function priceToPercent($price, $priceCommision)
{
    if(empty($priceCommision)) return 0;
    return (100/$price)*$priceCommision;
}

function percent($price, $percent = null)
{
    if(empty($percent)) return 0;
    return ($percent/100)*$price;
}

function prepareCode($code) {   
    if (!strpos($code, '-') && strlen($code) >= 4) 
    {
        $code = substr($code, 0, 3) . '-' . substr($code, 3, 4);
    }
    return $code;
}

function prepareExpiryDate($str, $exp = false){
    if (!strpos($str, '/') && strlen($str) >= 4) 
    {
        $str = substr($str, 0, 2) . '/' . substr($str, 2, 4);
    }
    return $exp ? explode('/', $str) : $str;
}

function getAppUrl($subdomain = false, $path = ''){
    $pre = 'http://';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') { 
      $pre = 'https://';
    }
    $domain = config('app.base_domain');
    if (!empty($subdomain)) {
        $domain = $subdomain . '.' . $domain;
    }
    $url = $pre . $domain;
    if ($path) {
        $url .= '/' . trim(rtrim($path, '/'), '/');
    }
    return $url; 
}

function offLink(){
    return 'style="cursor:default !important;" onclick="return false;"';
}

function percentFormat($percent=null, $zecimals = 1)
{
    if (empty($percent)) return '0'; 
    return number_format($percent, $zecimals, '.', ' ');
}

function generate_id($length=6)
{
    $number = '';
    for ($i=$length; $i--; $i>0) {
        $number .= mt_rand(0,9);
    }
    return $number;
} 

function random_str(
    $length=6,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz!#$%^&*()_+'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

function sortValue($arr){
    if (empty($arr)) return;

    $data = array();
    foreach ($arr as $l_key => $l_value)
    {
        $i=0;
        foreach ($l_value as $key => $value)
        {
            $data[$key][$l_key] = $arr[$l_key][$key];
            $i++;
        }
    }
    return $data;
}

if (!function_exists('map_tree')) {
    function map_tree($dataset)
    {
        $dataset = key_to_id($dataset);
        $tree    = array();
        foreach ($dataset as $id => &$node) {
            if (empty($node['parent_id'])) {
                $tree[$id] =& $node;
            } else {
                $dataset[$node['parent_id']]['childs'][$id] =& $node;
            }
        }
        return $tree;
    }
}

function d()
{
    array_map(function ($x) {
        (new \Illuminate\Support\Debug\Dumper)->dump($x);
    }, func_get_args());
}

if (!function_exists('print_arr')) {
    function print_arr($array)
    {
        echo "<pre>" . print_r($array, true) . "</pre>";
    }
}

function setAdminUri($uri)
{
    return '/' . config('admin.path') .  '/' . $uri;
}

function prepareArrayForJson($array)
{
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
    return str_replace($escapers, $replacements, json_encode($array));
}

function userRoute($route)
{ 
    $define = Auth::user()->userType->define;
    return $define . '_' . $route;
}

function isActive($route, $domain='')
{   
    return (request()->url() == $route) ? true :  false;
}

function adminMenu()
{
    return [
        'menu' => [
            'name' => 'Меню',
            'icon' => '<i data-feather="list"></i>',
            'link' => '/'.config('admin.path').'/menu/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        'catalog' => [
            'name'   => 'Каталог',
            'icon'   => '<i data-feather="book"></i>',
            'link'   => '/'.config('admin.path').'/catalog/categories',
            'view'   => true,
            'edit'   => 'Редактировать',
            'childs' => [

                'categories' => [
                    'name' => 'Категории',
                    'link' => '/'.config('admin.path').'/catalog/categories/',
                    'view' => true,
                    'edit' => 'Редактировать'
                ],

                'tags' => [
                    'name' => 'Тэги',
                    'link' => '/'.config('admin.path').'/catalog/tags/',
                    'view' => true,
                    'edit' => 'Редактировать'
                ],

                'chars' => [
                    'name' => 'Характеристики',
                    'link' => '/'.config('admin.path').'/catalog/chars/',
                    'view' => true,
                    'edit' => 'Редактировать'
                ],

                'products' => [
                    'name' => 'Товары',
                    'link' => '/'.config('admin.path').'/catalog/products/',
                    'view' => true,
                    'edit' => 'Редактировать'
                ],
            ]
        ],

        'users' => [
            'name' => 'Пользователи',
            'icon' => '<i data-feather="users"></i>',
            'link' => '/'.config('admin.path').'/users/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        'slider' => [
            'name' => 'Слайдер',
            'icon' => '<i data-feather="image"></i>',
            'link' => '/'.config('admin.path').'/slider/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        'banners' => [
            'name' => 'Баннера',
            'icon' => '<i data-feather="layout"></i>',
            'link' => '/'.config('admin.path').'/banners/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        'brands' => [
            'name' => 'Брэнды',
            'icon' => '<i data-feather="layout"></i>',
            'link' => '/'.config('admin.path').'/brands/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

//        'advantages' => [
//            'name' => 'Преимущества',
//            'icon' => '<i data-feather="star"></i>',
//            'link' => '/'.config('admin.path').'/advantages/',
//            'view' => true,
//            'edit' => 'Редактировать'
//        ],

        'email-templates' => [
            'name' => 'E-mail Шаблоны',
            'icon' => '<i data-feather="mail"></i>',
            'link' => '/'.config('admin.path').'/email-templates/',
            'view' => true,
            'edit' => 'Редактировать'
        ],  

        'settings' => [
            'name' => 'Настройки',
            'icon' => '<i data-feather="settings"></i>',
            'link' => '/'.config('admin.path').'/settings/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        'constants' => [
            'name' => 'Константы',
            'icon' => '<i data-feather="anchor"></i>',
            'link' => '/'.config('admin.path').'/constants/',
            'view' => true,
            'edit' => 'Редактировать'
        ],

        // Скрытые страницы

        'profile' => [
            'name' => 'Профиль',
            'link' => '/'.config('admin.path').'/profile/',
            'view' => false,
            'edit' => 'Редактировать'
        ]
    ]; 
}
 

//function auctionType($type){
//    $types = [
//        ''
//    ];
//}

function setting($key)
{
    return \App\Utils\Settings::get($key);
}

function key_to_id($array) {
    if (empty($array)) {
        return array();
    }
    $new_arr = array();
    foreach ($array as $id => &$node) {
        $new_arr[$node['id']] =& $node;
    }
    return $new_arr;
}



function tree($dataset)
{
    if($dataset instanceof Illuminate\Database\Eloquent\Collection){
        $dataset = $dataset->toArray();
    }
    $dataset = key_to_id($dataset);
    $tree    = array();
    foreach ($dataset as $id => &$node) {
        if (!$node['parent_id']) {
            $tree[$id] =& $node;
        } else {
            $dataset[$node['parent_id']]['childs'][$id] =& $node;
        }
    }
    return $tree;
}

function uri($segment)
{
    return request()->segment($segment);
}

function isActiveLink($route)
{
    if($route == \Request::url())
    {
        return true;
    }
}

function lang()
{
    return \App::getLocale();
}

function setUri($uri){
    return '/' . lang() . '/' . trim($uri, '/');
}

function sepByNum($num) {
    if ($num > 0) {
        $sep = '';
        for ($i = $num; $i > 0; $i--) {
            $sep .= '— ';
        }
        return $sep;
    }
}

function sessArray($name) {
    return \App\Utils\ArraySess::init($name);
}

function priceString($price = null, $zecimals = 0, $space = ' '){
    if (empty($price)) return '0'; 
    return number_format($price, $zecimals, '.', $space);
}

function bigNumberFormat($number)
{
    return number_format($number, '0', ',', ',');
}

function toFloat($s) {
    // convert "," to "."
    $s = str_replace(',', '.', $s);

    // remove everything except numbers and dot "."
    $s = preg_replace("/[^0-9\.]/", "", $s);

    // remove all seperators from first part and keep the end
   // $s = str_replace('.', '',substr($s, 0, -3)) . substr($s, -3);

    // return float
    return (float) $s;
}  

function uploadBase64($base64, $path){
    $data = $base64;
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));    
    file_put_contents($path, $data); 
}

function setLangUri($lang){
    $url  = \Request::path();

    $a    = array_slice(explode('/', $url), 1);
    $b    = implode('/', $a);
    $link = $b.(!empty(\Request::server('QUERY_STRING')) ? '?'.\Request::server('QUERY_STRING') : '');

    return "/$lang/" .$link;
}


function imageThumb($image = false, $path, $width, $height=null, $v)
{ 
    $height = empty($height) ? null : $height;
    $path = str_replace('.', '/', $path); 

    $thumbPath = '/thumb';
    if (!is_dir(public_path($path . "/thumb"))) 
    {  
        mkdir(public_path($path . "/thumb"), 0777);
        chmod(public_path($path . "/thumb"), 0777);
    }

    if (!empty($v)) 
    {
        if (!is_dir(public_path($path . "/thumb/version_$v"))) 
        { 
            mkdir(public_path($path . "/thumb/version_$v"), 0777);
            chmod(public_path($path . "/thumb/version_$v"), 0777);
        }
        $thumbPath .= "/version_$v";
    }

    $imgeThumbnailPath = public_path($path . $thumbPath . "/$image");
    $filePath          = public_path($path . "/$image");

    if (empty($image)) {
        $explodePath = explode('/', $path);
        $defImg = 'no-image.png';
        if (end($explodePath) == 'clients')
        {
            $defImg = 'no-avatar.png';
        }  

        $filePath = public_path('uploads/' . $defImg);
    }

    if ((!file_exists($imgeThumbnailPath) && file_exists($filePath)) or empty($image)) 
    {     
        if (!empty($height) && !empty($width)) 
        {
            $img = Image::make($filePath)->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        else
        {
            $img = Image::make($filePath)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });  
        }

        if (empty($image)) { 
            $img->save(public_path($path . $thumbPath . "/" . $defImg));
            return '/' . $path . $thumbPath . "/" . $defImg;
        }
        $img->save($imgeThumbnailPath); 
    }     
    return env('APP_URL') . '/' . $path . $thumbPath . "/$image"; 
}

function getDiffYears($date)
{
    $d1 = new DateTime(date('Y-m-d'));
    $d2 = new DateTime($date); 
    $diff = $d2->diff($d1);  
    return $diff->y;
}

function getDiffDateTime($date)
{
    $d1 = new DateTime(date('Y-m-d H:i:s'));
    $d2 = new DateTime($date); 
    $diff = $d2->diff($d1);  
    return $diff;
}

function montName($date)
{
    $date = strtotime($date);
    $_nr_month = date('m', $date);
    switch ($_nr_month) {
        case '01':
            $m = 'Января';
            break;
        case '02':
            $m = 'Февраля';
            break;
        case '03':
            $m = 'Марта';
            break;
        case '04':
            $m = 'Апреля';
            break;
        case '05':
            $m = 'Мая';
            break;
        case '06':
            $m = 'Июня';
            break;
        case '07':
            $m = 'Июля';
            break;
        case '08':
            $m = 'Августа';
            break;
        case '09':
            $m = 'сентября';
            break;
        case '10':
            $m = 'Октября';
            break;
        case '11':
            $m = 'Ноября';
            break;
        case '12':
            $m = 'Декабря';
            break;
        default:
            $m = $to_date;
            break;
    }
    return date('d ' . $m . ' Y', $date);
}

function format_by_count($count, $form1, $form2, $form3)
{
    $count = abs($count) % 100;
    $lcount = $count % 10;
    if ($count >= 11 && $count <= 19) return($form3);
    if ($lcount >= 2 && $lcount <= 4) return($form2);
    if ($lcount == 1) return($form1);
    return $form3;
}

function strFormat($field, $lang=false)
{

    if (empty($lang)) {
        $lang = lang();
    }  

    $arr = [
        'days' => [
            'ru' => [
                'день',
                'дня',
                'дней'
            ],

            'ro' => [
                'zi',
                'zile',
                'zile'
            ],

            'en' => [
                'day',
                'days',
                'days'
            ],
        ],

        'hours' => [
            'ru' => [
                'час',
                'часа',
                'часов'
            ],

            'ro' => [
                'ora',
                'ore',
                'ore'
            ],

            'en' => [
                'hours',
                'hours',
                'hours'
            ],
        ],

        'minutes' => [
            'ru' => [
                'минута',
                'минуты',
                'минут'
            ],

            'ro' => [
                'minut',
                'minute',
                'minute'
            ],

            'en' => [
                'minute',
                'minutes',
                'minutes'
            ],
        ],

        'seconds' => [
            'ru' => [
                'секунда',
                'секунды',
                'секунд'
            ],

            'ro' => [
                'secunda',
                'secunde',
                'secunde'
            ],

            'en' => [
                'second',
                'seconds',
                'seconds'
            ],
        ]
    ];

    return $arr[$field][$lang];
}

function field($key, $lang = false){
    
    if (empty($lang)) {
        $lang = lang();
    }  

    $translate = array(  
        'name' => array(
            'ru' => 'Имя',
            'ro' => 'Numele',
            'en' => 'Name'
        ), 

        'surname' => array(
            'ru' => 'Фамилия',
            'ro' => 'Prenume',
            'en' => 'Surname'
        ), 

        'denom' => array(
            'ru' => 'Название',
            'ro' => 'Denumire',
            'en' => 'Name'
        ),  

        'lasts' => array(
            'ru' => 'Длится',
            'ro' => 'Dureaza',
            'en' => 'Lasts'
        ), 

        'type' => array(
            'ru' => 'Тип',
            'ro' => 'Tipul',
            'en' => 'Type'
        ), 

        'select' => array(
            'ru' => 'Выбрать',
            'ro' => 'Alege',
            'en' => 'Select'
        ),  
  
        'comment' => array(
            'ru' => 'Комментарий',
            'ro' => 'Mesaj',
            'en' => 'Comment'
        ),  

        'pass' => array(
            'ru' => 'пароль',
            'ro' => 'Parola',
            'en' => 'Password'
        ),   

        'repeat_pass' => array(
            'ru' => 'Подтверждение пароля',
            'ro' => 'Parola din nou',
            'en' => 'Repeat password'
        ),   
 
        'ph_nr' => array(
            'ru' => 'Номер телефона',
            'ro' => 'Numarul de tel.',
            'en' => 'Phone number'
        ),

        
        'msg' => array(
            'ru' => 'Сообщение',
            'ro' => 'Mesaj',
            'en' => 'Message'
        ),  

        'title' => array(
            'ru' => 'Заголовок',
            'ro' => 'Subiect',
            'en' => 'Title'
        ),  
  
        'close' => array(
            'ru' => 'Закрыть',
            'ro' => 'închide',
            'en' => 'Close'
        ),  

        'avatar' => array(
            'ru' => 'Аватар',
            'ro' => 'Avatar',
            'en' => 'Avatar'
        ),  
         
 
    );  

    if (!empty($translate[$key][$lang])) {
        return $translate[$key][$lang];
    }
} 

function generateAccountNumber()
{
    $accountNumber = (int) \App\Models\User::select('account_number')->get()->pluck('account_number')->map(function($account_number){
        return (int) str_replace( '0', '', $account_number);
    })->max()+1;

    $zeros='';
    for ($i=0; $i < (12-strlen($accountNumber)); $i++ ){
        $zeros .= 0;
    }
    return $zeros.$accountNumber;
}

function cart() {
    return app('cart');
}

if (!function_exists('toUrl')) {
    function toUrl($str, $separator = 'dash', $lowercase = true)
    {
        if ($separator == 'dash') {
            $search  = '_';
            $replace = '-';
        } else {
            $search  = '-';
            $replace = '_';
        }
        $trans    = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );
        $translit = array(
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "c",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "",
            "ы" => "y",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "А" => "a",
            "Б" => "b",
            "В" => "v",
            "Г" => "g",
            "Д" => "d",
            "Е" => "e",
            "Ж" => "zh",
            "З" => "z",
            "И" => "i",
            "Й" => "y",
            "К" => "k",
            "Л" => "l",
            "М" => "m",
            "Н" => "n",
            "О" => "o",
            "П" => "p",
            "Р" => "r",
            "С" => "s",
            "Т" => "t",
            "У" => "u",
            "Ф" => "f",
            "Х" => "h",
            "Ц" => "c",
            "Ч" => "ch",
            "Ш" => "sh",
            "Щ" => "sch",
            "Ъ" => "",
            "Ы" => "y",
            "Ь" => "",
            "Э" => "e",
            "Ю" => "yu",
            "Я" => "ya",
            " " => "_",
            "," => ""
        );
        $str      = strtr($str, $translit);
        $str      = strip_tags($str);
        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }
        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }
        return trim(stripslashes($str));
    }
}