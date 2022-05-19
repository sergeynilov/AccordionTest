<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Database\QueryException;

//use App\Models\User;
//use Auth;
use App\Models\User;

//use App\Models\AppImage;
use App\Models\Settings;
use Illuminate\Support\Str;

if ( ! function_exists('convertNotificationIntoLabel')) {
    function convertNotificationIntoLabel($value, $field)
    {
        if ($field == 'type') {
            if ($value == 'App\Notifications\CurrencyRatesImportRunNotification') {
                return 'Currency rates import';
            }
            if ($value == 'App\Notifications\ContactUsCreatedNotification') {
                return 'Contact Us';
            }
        }

        return $value;
    }
} // if ( ! function_exists('convertNotificationIntoLabel')) {

if ( ! function_exists('getRequestIp')) {
    function getRequestIp()
    {
        $request = request();

        return $user_ip_address = $request->ip();
    }
} // if ( ! function_exists('getRequestIp')) {

if ( ! function_exists('workTextString')) {
    /* Submitting form string value must be worked out according to options of app */
    function workTextString($str, $skip_strip_tags = false)
    {
        if (is_string($str) and ! $skip_strip_tags) {
            $str = makeStripTags($str);
        }
        if (is_string($str)) {
            $str = makeStripslashes($str);
        }
        if (is_string($str)) {
            $str = makeClearDoubledSpaces($str);
        }

        return is_string($str) ? trim($str) : '';
    }
} // if ( ! function_exists('workTextString')) {

if ( ! function_exists('makeStripTags')) {
    function makeStripTags(string $str)
    {
        return strip_tags($str);
    }
} // if ( ! function_exists('makeStripTags')) {

if ( ! function_exists('makeStripslashes')) {
    function makeStripslashes(string $str): string
    {
        return stripslashes($str);
    }
} // if ( ! function_exists('makeStripslashes')) {

if ( ! function_exists('make64Decode')) {
    function make64Decode($data)
    {
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        return $data;
    }
} // if ( ! function_exists('make64Decode')) {

////// NEWS BLOCK START /////

if ( ! function_exists('getAppImagePublishedLabel')) {
    function getAppImagePublishedLabel($published): string
    {
        return AppImage::getAppImagePublishedLabel($published);
    }
} // if ( ! function_exists('getAppImagePublishedLabel')) {


if ( ! function_exists('getAppImageIsOnlyForAdminLabel')) {
    function getAppImageIsOnlyForAdminLabel($is_only_for_admin): string
    {
        return AppImage::getAppImageIsOnlyForAdminLabel($is_only_for_admin);
    }
} // if ( ! function_exists('getAppImageIsOnlyForAdminLabel')) {
////// NEWS BLOCK END /////


if ( ! function_exists('getYesNoLabel')) {
    function getYesNoLabel($val): string
    {
        if (strtoupper($val) == 'N') {
            return 'No';
        }
        if (strtoupper($val) == 'Y') {
            return 'Yes';
        }

        return $val ? 'Yes' : 'No';
    }
} // if ( ! function_exists('getYesNoLabel')) {


////// NEWS BLOCK START /////
if ( ! function_exists('getNewsPublishedLabel')) {
    function getNewsPublishedLabel($published): string
    {
        return News::getNewsPublishedLabel($published);
    }
} // if ( ! function_exists('getNewsPublishedLabel')) {


if ( ! function_exists('getNewsIsHomepageLabel')) {
    function getNewsIsHomepageLabel($is_homepage): string
    {
        return News::getNewsIsHomepageLabel($is_homepage);
    }
} // if ( ! function_exists('getNewsIsHomepageLabel')) {

if ( ! function_exists('getNewsIsTopLabel')) {
    function getNewsIsTopLabel($is_top): string
    {
        return News::getNewsIsTopLabel($is_top);
    }
} // if ( ! function_exists('getNewsIsTopLabel')) {
////// NEWS BLOCK END /////

if ( ! function_exists('featuredHostelTooltipText')) {
    function featuredHostelTooltipText(): string
    {
        return 'Featured hostel tooltip text lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et';
    }
} // if ( ! function_exists('featuredHostelTooltipText')) {

if ( ! function_exists('getRatingIconColor')) {
    function getRatingIconColor($rating): string
    {
        if ($rating >= 4.5) {
            return '#fc010e';
        }
        if ($rating >= 4.0) {
            return '#fc5a24';
        }
        if ($rating >= 3.5) {
            return '#fca29a';
        }
        if ($rating >= 3.0) {
            return '#bcc6a6';
        }
        if ($rating >= 2.5) {
            return '#9ea68b';
        }
        if ($rating >= 2.0) {
            return '#818871';
        }
        if ($rating >= 1.0) {
            return '#505446';
        }
        if ($rating > 0) {
            return '#000000';
        }

        return '#000000';
    }
} // if ( ! function_exists('getRatingIconColor')) {



//
if ( ! function_exists('isUserLogged')) {
    function isUserLogged()
    {
        return Auth::user();
    }
} // if ( ! function_exists('isUserLogged')) {


if ( ! function_exists('formatCurrencySum')) {
    function formatCurrencySum($currency_sum, $show_only_digits = false, $output_format = ''): string
    {
        $current_currency_short    = config('app.current_currency_short');
        $current_currency_position = config('app.current_currency_position'); // p-prefix , s-suffix

        if ($current_currency_position == 'p') {
            return ($show_only_digits ? '' : $current_currency_short) . getCFPriceFormat($currency_sum);
        }


        return getCFPriceFormat($currency_sum) . ($show_only_digits ? '' : $current_currency_short);
    }
} // if ( ! function_exists('formatCurrencySum')) {


if ( ! function_exists('countNonEmptyValues')) {
    function countNonEmptyValues($arrData)
    {
        $ret = 0;
        foreach ($arrData as $nextData) {
            if ( ! empty($nextData)) {
                $ret++;
            }
        }

        return $ret;
    }
} // if ( ! function_exists('countNonEmptyValues')) {

if ( ! function_exists('getUserPermissionNames')) {
    function getUserPermissionNames($userItem)
    {
        if (empty($userItem) or class_basename($userItem) != 'User') {
            return;
        }
        $userItem->slashed_name = addslashes($userItem->name);
        $permissionsLabel       = '';
        foreach ($userItem->getPermissionNames() as $v) {
            $permissionsLabel .= $v . ', ';
        }
        $permissionsLabel = trimRightSubString(trim($permissionsLabel), ',');

        return $permissionsLabel;

    }
} // if ( ! function_exists('getUserPermissionNames')) {

if ( ! function_exists('readSettingsValue')) {
    function readSettingsValue($key)
    {
        return Settings::getValue($key);
    }
} // if ( ! function_exists('readSettingsValue')) {


if ( ! function_exists('getSettingsValueByKey')) {
    function getSettingsValueByKey($settingsArray, $fieldName, $resultField = 'value')
    {
        foreach ($settingsArray as $next_key => $nextSettings) {
//            echo '<pre>-- $nextSettings::'.print_r($nextSettings,true).'</pre>';
            if ($nextSettings['name'] == $fieldName) {
//                echo '<pre>$fieldName::'.print_r($fieldName,true).'</pre>';
//                echo '<pre>$fieldName . \'_settingsPropsArray\'::'.print_r($fieldName . '_settingsPropsArray',true).'</pre>';

                if ( ! empty($nextSettings[$fieldName . '_settingsPropsArray'])) {
//                    echo '<pre>-2::</pre>';
                    return $nextSettings[$fieldName . '_settingsPropsArray'];
                } else {
//                    echo '<pre>-3::</pre>';
//                    return $nextSettings->value ?? null;
                    return $nextSettings[$resultField] ?? null;
                }
            }
            /*             [name] => app_big_logo
                        [value] => 1.png
                        [created_at] => 2020-11-27 09:04:23
                        [updated_at] => 2021-03-27 11:15:15
                        [app_big_logo_settingsPropsArray] => Array
                            ( */
        }

        return '';
    }
} // if ( ! function_exists('getSettingsValueByKey')) {

if ( ! function_exists('pluralize3')) {
    function pluralize3($itemsLength, $noItemsText, $singleItemText, $multiItemsText)
    {
        if (gettype($itemsLength) === 'undefined') {
            return '';
        }
        if (gettype($itemsLength) === 'integer' && $itemsLength <= 0) {
            return $noItemsText;
        }
        if (gettype($itemsLength) === 'integer' && $itemsLength === 1) {
            return $singleItemText;
        }
        if (gettype($itemsLength) === 'integer' && $itemsLength > 1) {
            return $multiItemsText;
        }

        return '';
    }
} // if ( ! function_exists('pluralize3')) {

if ( ! function_exists('getPaginationNextUrlLinks')) {
    function getPaginationNextUrlLinks($totalCategoriesCount, $itemsCount, $backendItemsPerPage, $page = 1)
    {
        $nextUrlLinks = [];
//        if($itemsCount>0){
        if ($itemsCount >= $backendItemsPerPage) {
            $MaxPage = floor($totalCategoriesCount / $backendItemsPerPage) + ($totalCategoriesCount % $backendItemsPerPage > 0 ? 1 : 0);
            for ($i = $page + 1; $i <= $MaxPage; $i++) {
                $nextUrlLinks[] = $i;
            }
        }

//        }
        return $nextUrlLinks;
    }
} // if ( ! function_exists('getPaginationNextUrlLinks')) {

if ( ! function_exists('getPaginationPrevUrlLinks')) {
    function getPaginationPrevUrlLinks($startRowsFrom, $backendItemsPerPage, $page = 1)
    {
        $prevUrlLinks = [];
        if ($startRowsFrom > 0) {
            $i          = $backendItemsPerPage;
            $pageNumber = 1;
            while ($i < $page * $backendItemsPerPage - 1) {
                $i              += $backendItemsPerPage;
                $prevUrlLinks[] = $pageNumber;
                $pageNumber++;
            }
        }

        return $prevUrlLinks;
    }
} // if ( ! function_exists('getPaginationPrevUrlLinks')) {


if ( ! function_exists('crlf')) {
    function crlf(string $s): string
    {
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $s);
    }
} // if ( ! function_exists('crlf')) {



if ( ! function_exists('getSystemInfo')) {
    function getSystemInfo()
    {
        $DB_CONNECTION = config('database.default');
        $connections   = config('database.connections');
        $database_name = ! empty($connections[$DB_CONNECTION]['database']) ? $connections[$DB_CONNECTION]['database'] : '';

        $pdo           = DB::connection()->getPdo();
        $db_version    = $pdo->query('select version()')->fetchColumn();
        $tables_prefix = DB::getTablePrefix();

        ob_start();
        phpinfo();
        $phpinfo_str = ob_get_contents() . '<hr>';
        ob_end_clean();
        $server_info = '<hr><pre>' . print_r($_SERVER, true) . '</pre>';

        $app_version = '';
        if (file_exists(public_path('app_version.txt'))) {
            $app_version = File::get('app_version.txt');
            if ( ! empty($app_version)) {
                $app_version = ' app_version : <b> ' . $app_version . '</b><br>';
            }
        }

        $is_running_under_docker_text = '';
        if (isRunningUnderDocker()) {
            $is_running_under_docker_text = '<b>Running Under Docker</b><br>';
        }

        $runningUnderDocker = (isRunningUnderDocker() ? '<strong>UnderDocker</strong>' : 'No Docker');
        $string             = '<br><table style="border: 1px dotted red; width: 100% !important;" >' .
                              '<tr><td style="border: 2px dotted blue; width: 100% !important;">' .
                              ' Laravel:<b>' . app()::VERSION . '</b><br>' .
                              'PHP:<b>' . phpversion() . '</b><br>' .
                              'DEBUG:<b>' . config('app.debug') . '</b><br>' .
                              'PHP SAPI NAME:<b>' . php_sapi_name() . '</b><br>' .
                              'ENV:<b>' . config('app.env') . '</b><br>' .
                              'DB CONNECTION:<b> ' . $DB_CONNECTION . ' </b><br>' .
                              'DB VERSION:<b> ' . $db_version . '</b><br>' .
                              'DB DATABASE:<b> ' . $database_name . '</b><br>' .
                              'TABLES PREFIX:<b> ' . $tables_prefix . '</b><br>' .

                              '<hr>' .
                              'base_path: <b>' . base_path() . '</b><br>' .
                              'app_path: <b>' . app_path() . '</b><br>' .
                              'public_path: <b>' . public_path() . '</b><br>' .
                              'storage_path: <b>' . storage_path() . '</b><br>' .
                              'Path to the \'storage/app\' folder: <b>' . storage_path('app') . '</b><br>' .
                              $app_version .
                              $is_running_under_docker_text .
                              '<hr>' .

                              '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:500px; max-width:900px;">' . $phpinfo_str . '</div></div>' .
                              '<hr><div>' . $runningUnderDocker . '</div>' .
                              '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:500px; max-width:900px;">' . $server_info . '</div></div>' .
                              '</td></tr>' .
                              '</table>';
        '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:300px; max-width:600px;">' . $phpinfo_str . '</div></div>' .
        '<hr><div>' . $runningUnderDocker . '</div>' .
        '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:300px; max-width:600px;">' . $server_info . '</div></div>';

        return $string;
    }
} // if ( ! function_exists('getSystemInfo')) {


if ( ! function_exists('getValueLabelKeys')) {
    function getValueLabelKeys(array $arr): string
    {
        $keys    = array_keys($arr);
        $ret_str = '';
        foreach ($keys as $next_key) {
            $ret_str .= $next_key . ',';
        }

        return trimRightSubString($ret_str, ',');
    }

} // if ( ! function_exists('getValueLabelKeys')) {



if ( ! function_exists('varDump')) {
    function varDump($var, $descr = '', bool $return_string = true)
    {
        if (is_null($var)) {
            $output_str = 'NULL :' . (! empty($descr) ? $descr . ' : ' : '') . 'NULL';
            if ($return_string) {
                return $output_str;
            }

            return;
        }
        if (is_scalar($var)) {
            $output_str = 'scalar => (' . gettype($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . $var;
            if ($return_string) {
                return $output_str;
            }
            \Log::info($output_str);

            return;
        }
        if (is_array($var)) {
            $output_str = '[]';
            if (isset($var[0])) {
                if (is_subclass_of($var[0], 'Illuminate\Database\Eloquent\Model')) {
                    $collectionClassBasename = class_basename($var[0]);
                    $output_str              = ' Array(' . count(collect($var)->toArray()) . ' of ' . $collectionClassBasename . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r(collect($var)->toArray(),
                            true);
                } else {
                    $output_str = 'Array(' . count($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r($var,
                            true);
                }
            } else {
                $output_str = 'Array(' . count($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r($var,
                        true);
            }

            if ($return_string) {
                return $output_str;
            }

            return;
        }

        if (class_basename($var) === 'Request' or class_basename($var) === 'LoginRequest') {
            $request     = request();
            $requestData = $request->all();
            $output_str  = 'Request:' . (! empty($descr) ? $descr . ' : ' : '') . print_r($requestData,
                    true);
            if ($return_string) {
                return $output_str;
            }
            \Log::info($output_str);

            return;
        }

        if (class_basename($var) === 'LengthAwarePaginator' or class_basename($var) === 'Collection') {
            $collectionClassBasename = '';
            if (isset($var[0])) {
                $collectionClassBasename = class_basename($var[0]);
            }
            $output_str = ' Collection(' . count($var->toArray()) . ' of ' . $collectionClassBasename . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r($var->toArray(),
                    true);
            if ($return_string) {
                return $output_str;
            }
            \Log::info($output_str);

            return;
        }

        /*        if (!is_subclass_of($model, 'Illuminate\Database\Eloquent\Model')) {
                }*/
        if (gettype($var) === 'object') {
            if (is_subclass_of($var, 'Illuminate\Database\Eloquent\Model')) {
                $output_str = ' (Model Object of ' . get_class($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r($var/*->getAttributes()*/ ->toArray(),
                        true);
                if ($return_string) {
                    return $output_str;
                }
                \Log::info($output_str);

                return;
            }
            $output_str = ' (Object of ' . get_class($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r((array)$var,
//            $output_str = ' (Object of ' . get_class($var) . ') :' . (! empty($descr) ? $descr . ' : ' : '') . print_r((array)json_encode($var),
                    true);
            if ($return_string) {
                return $output_str;
            }
            \Log::info($output_str);

            return;
        }
    }
} // if ( ! function_exists('varDump')) {


if ( ! function_exists('prefixHttpProtocol')) {
    function prefixHttpProtocol($url)
    {
        if ( ! (strpos('http://', $url) === false) or ! (strpos('https://', $url) === false)) {
            return $url;
        }
        $request = request();
        if ($request->secure()) {
            return 'https://' . $url;
        }

        return 'http://' . $url;
    }
} // if ( ! function_exists('prefixHttpProtocol')) {


if ( ! function_exists('clearValidationError')) {
    function clearValidationError(string $str, array $clearArray): string
    {
        foreach ($clearArray as $next_key => $next_value) {
            $str = str_replace($next_key, $next_value, $str);
        }

        return $str;
    }
} // if (! function_exists('clearValidationError')) {

if ( ! function_exists('getConcatStrMaxLength')) {
    function getConcatStrMaxLength(): int
    {
        return 50;
    }
} // if (! function_exists('getConcatStrMaxLength')) {


if ( ! function_exists('safeFilename')) {
    function safeFilename(string $filename): string
    {
        return preg_replace("/[^A-Za-z ]/", '', $filename);
    }
} // if (! function_exists('safeFilename')) {

if ( ! function_exists('addAppMetaKeywords')) {
    function addAppMetaKeywords(array $arr): array
    {
        $arr[] = Settings::getValue('site_name');
        $arr[] = Settings::getValue('site_heading');
        $arr[] = Settings::getValue('site_subheading');

        return $arr;
    }
} // if (! function_exists('addAppMetaKeywords')) {

if ( ! function_exists('isValidBool')) {
    function isValidBool($val): bool
    {
        if (in_array($val, ["Y", "N"])) {
            return true;
        } else {
            return false;
        }
    }
} // if (! function_exists('isValidBool')) {

if ( ! function_exists('isValidInteger')) {
    function isValidInteger($val): bool
    {
        if (preg_match('/^[0-9]*$/', $val)) {
//        if (preg_match('/^[1-9][0-9]*$/', $val)) {
            return true;
        } else {
            return false;
        }
    }
} // if (! function_exists('isValidInteger')) {

if ( ! function_exists('isValidFloat')) {
    function isValidFloat($val): bool
    {
        if (preg_match('/^[+-]?([0-9]*[.])?[0-9]+$/', $val)) {
            return true;
        } else {
            return false;
        }
    }
} // if (! function_exists('isValidFloat')) {

if ( ! function_exists('getFileExtensionsImageUrl')) {
    function getFileExtensionsImageUrl(string $filename): string
    {
        $fileExtensionsImages = config('app.fileExtensionsImages');
        $filename_extension   = getFilenameExtension($filename);
        foreach ($fileExtensionsImages as $next_extension => $next_extension_file) {
            if (strtolower($next_extension) == $filename_extension) {
                $extension_filename = with(new Settings)->getFilesExtentionDir() . $next_extension_file;

                return $extension_filename;
            }
        }

        return '';
    }
} // if (! function_exists('getFileExtensionsImageUrl')) {

if ( ! function_exists('getFilenameBasename')) {
    function getFilenameBasename($file)
    {
        return File::name($file);
    }
} // if (! function_exists('getFilenameBasename')) {

if ( ! function_exists('getFilenameExtension')) {
    function getFilenameExtension($file)
    {
        return File::extension($file);
    }
} // if (! function_exists('getFilenameExtension')) {

if ( ! function_exists('splitStrIntoArray')) {
    function splitStrIntoArray($str, $splitter_1, $splitter_2 = '=', $output_format = 'array')
    {
//        echo '<pre>splitStrIntoArray  $str::'.print_r($str,true).'</pre>';
//        echo '<pre>splitStrIntoArray  $splitter_1::'.print_r($splitter_1,true).'</pre>';
//        echo '<pre>splitStrIntoArray  $splitter_2::'.print_r($splitter_2,true).'</pre>';
        $retArray = array();
        $A        = preg_split('/' . $splitter_1 . '/', $str);
        foreach ($A as $key => $val) {
            if (empty($splitter_2)) {
                $retArray[] = $val;
            } else {
//                echo '<pre>$splitter_2;'.print_r($splitter_2,true).';</pre>';
                $A_2 = preg_split('/' . $splitter_2 . '/', $val);
//                echo '<pre>$A_2::'.print_r($A_2,true).'</pre>';
                if (count($A_2) == 2) {
                    $retArray[$A_2[0]] = $A_2[1];
                }
                if (count($A_2) > 2) {
                    $A_2_text = '';
                    for ($i = 1; $i < count($A_2); $i++) {
                        $A_2_text .= $A_2[$i] . ($i < count($A_2) - 1 ? $splitter_2 : "");
                    }
//                    $retArray[$A_2[0]] = $A_2[1];
                    $retArray[$A_2[0]] = $A_2_text;
                }
            }
        }
        if ($output_format == 'array') {
            return $retArray;
        }
//        echo '<pre>$retArray::'.print_r($retArray,true).'</pre>';
        if ($output_format == 'string_2_array') {
//            return ' \'{  "S:61" : \'801\' ,  "S:63" : \'840\'  }';
//            return '{"a": 1, "b": {"c": "d", "e": true}}';
            $ret_str = '{ ';
            foreach ($retArray as $next_key => $next_value) {
//                $ret_str.= ' { "'.$next_key.'":'. "'" . $next_value."' }, ";
                $ret_str .= ' "' . $next_key . '" : ' . '"' . $next_value . '" , ';
            }
            $ret_str = trimRightSubString(trim($ret_str), ',');
            $ret_str .= ' }';

//            $ret_str.= ' }:jsonb ';

            return $ret_str;
        }
//        if ( $output_format == 'string_2_array' ) {
//            if (empty($retArray) or !is_array($retArray)) {
//                return "ARRAY []::varchar(255)[] ";
//            }
//            $ret_str= "ARRAY [";
//            $i= 1;
//            foreach( $retArray as $next_key=>$next_value ) {
//                $ret_str.= " ARRAY[ '".trim($next_key)."','".trim($next_value)."' ]".($i< count($retArray) ? "," :"")." ";
//                $i++;
//            }
//            $ret_str.= ' ]';
////            $ret_str.= ' ]::varchar(255)[][]';
//            return $ret_str;
//        }
        /* SELECT reduce_dim(array[array[1, 2], array[2, 3], array[4,5], array[9,10]]);
         reduce_dim */
    }
} // if (! function_exists('splitStrIntoArray')) {

if ( ! function_exists('trimRightSubString')) {
    function trimRightSubString(
        string $s,
        string $substr
    ): string {
        $res = preg_match('/(.*?)(' . preg_quote($substr, "/") . ')$/si', $s, $A);
        if ( ! empty($A[1])) {
            return $A[1];
        }

        return $s;
    }

} // if (! function_exists('trimRightSubString')) {

if ( ! function_exists('isFakeEmail')) {
    function isFakeEmail(string $email): string
    {
        $settingsArray = Settings::getSettingsList(['site_name']);
        $site_name     = ! empty($settingsArray['site_name']) ? $settingsArray['site_name'] : '';

        $has_fake_text = false;
        $pos           = strpos($email, 'fake_');
        if ( ! ($pos === false)) {
            $has_fake_text = true;
        }

        $has_site_name_text = false;
        $pos                = strpos($email, $site_name);
        if ( ! ($pos === false)) {
            $has_site_name_text = true;
        }

        return $has_fake_text and $has_site_name_text;
    }
} // if (! function_exists('isFakeEmail')) {

if ( ! function_exists('makeAddHttpPrefix')) {
    function makeAddHttpPrefix(string $url): string
    {
        if (empty($url)) {
            return '';
        }
        $url = trim($url);
        $ret = checkRegexpHttpPrefix($url);
        if ( ! $ret) {
            return 'http://' . $url;
        }

        return $url;
    }
} // if (! function_exists('makeAddHttpPrefix')) {

if ( ! function_exists('checkRegexpHttpPrefix')) {
    function checkRegexpHttpPrefix($str)
    {
        $pattern = "~^http(s)?:\/\/~i";
        $res     = preg_match($pattern, $str);

        return $res;
    }
} // if (! function_exists('checkRegexpHttpPrefix')) {

if ( ! function_exists('capitalize')) {
    function capitalize($str)
    {
        return ucfirst($str);
    }

} // if (! function_exists('capitalize')) {


if ( ! function_exists('getNiceFileSize')) {
    function getNiceFileSize(
        $bytes,
        $binaryPrefix = true
    ) {
        if ($binaryPrefix) {
            $unit = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
            if ($bytes == 0) {
                return '0 ' . $unit[0];
            }

            return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))),
                    2) . ' ' . (isset($unit[$i]) ? $unit[$i] : 'B');
        } else {
            $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
            if ($bytes == 0) {
                return '0 ' . $unit[0];
            }

            return @round($bytes / pow(1000, ($i = floor(log($bytes, 1000)))),
                    2) . ' ' . (isset($unit[$i]) ? $unit[$i] : 'B');
        }
    }

} // if (! function_exists('getNiceFileSize')) {


if ( ! function_exists('concatStr')) {
    function concatStr(
        string $str,
        int $max_length = 0,
        string $add_str = ' ...',
        $show_help = false,
        $strip_tags = true,
        $additive_code = ''
    ): string {
        if ($strip_tags) {
            $str = strip_tags($str);
        }
        $ret_html = limitChars($str, (! empty($max_length) ? $max_length : getConcatStrMaxLength()),
            $add_str);
        if ($show_help and strlen($str) > $max_length) {
            $ret_html .= '<i class=" fa bars" style="font-size:larger;" hidden ' . $additive_code . ' ></i>';
        }

        return $ret_html;
    }
} // if (! function_exists('concatStr')) {


if ( ! function_exists('limitChars')) {
    function limitChars(
        $str,
        $limit = 100,
        $end_char = null,
        $preserve_words = false
    ) {
        $end_char = ($end_char === null) ? '&#8230;' : $end_char;

        $limit = (int)$limit;

        if (trim($str) === '' or strlen($str) <= $limit) {
            return $str;
        }

        if ($limit <= 0) {
            return $end_char;
        }

        if ($preserve_words == false) {
            return rtrim(substr($str, 0, $limit)) . $end_char;
        }
        // TO FIX AND DELETE SPACE BELOW
        preg_match('/^.{' . ($limit - 1) . '}\S* /us', $str, $matches);

        return rtrim($matches[0]) . (strlen($matches[0]) == strlen($str) ? '' : $end_char);
    }

} // if (! function_exists('limitChars')) {


if ( ! function_exists('limitWords')) {
    /**
     * Limits a phrase to a given number of words.
     *
     * @param string   phrase to limit words of
     * @param integer  number of words to limit to
     * @param string   end character or entity
     *
     * @return  string
     */
    function limitWords(
        $str,
        $limit = 100,
        $end_char = null
    ) {
        $limit    = (int)$limit;
        $end_char = ($end_char === null) ? '&#8230;' : $end_char;

        if (trim($str) === '') {
            return $str;
        }

        if ($limit <= 0) {
            return $end_char;
        }

        preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $str, $matches);

        // Only attach the end character if the matched string is shorter
        // than the starting string.
        return rtrim($matches[0]) . (strlen($matches[0]) === strlen($str) ? '' : $end_char);
    }
} // if (! function_exists('limitWords')) {

if ( ! function_exists('isRunningUnderDocker')) {
    function isRunningUnderDocker(): bool
    {
        if (empty($_SERVER['HTTP_HOST'])) {
            return false;
        }
        $docker_host = '127.0.0.1:8084';
//        echo '<pre>$_SERVER::'.print_r($_SERVER,true).'</pre>';
//        $mystring = 'abc';
        $pos = strpos($_SERVER['HTTP_HOST'], $docker_host);
        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }
} // if (! function_exists('isRunningUnderDocker')) {


if ( ! function_exists('isCliCommand')) {
    function isCliCommand()
    {
        if (strpos(php_sapi_name(), 'cli') !== false) {
            return true;
        }

        return false;
    }
} // if (! function_exists('isCliCommand')) {


if ( ! function_exists('isHttpsProtocol')) {
    function isHttpsProtocol()
    {
        if (empty($_SERVER['HTTP_HOST'])) {
            return false;
        }
        if ( ! (strpos($_SERVER['HTTP_HOST'], 'local-bi-currencies.com')) === false) {
            return true;
        }

        return false;
    }
} // if (! function_exists('isHttpsProtocol')) {

if ( ! function_exists('isDeveloperComp')) {
    function isDeveloperComp($check_debug = false)
    {
        if ( ! empty($_SERVER['HTTP_HOST'])) {
            $pos = strpos($_SERVER['HTTP_HOST'], 'local-bi-currencies.com');
            if ( ! ($pos === false)) {
                return true;
            }
        }
        if (isRunningUnderDocker()) {
            return true;
        }
        $app_developers_mode = Session::get('app_developers_mode', '');

        return ! empty($app_developers_mode);
    }
} // if (! function_exists('isDeveloperComp')) {

if ( ! function_exists('clearEmptyArrayItems')) {
    function clearEmptyArrayItems($arr): array
    {
        if (empty($arr)) {
            return [];
        }
        foreach ($arr as $next_key => $next_value) {
            if (empty($next_value)) {
                unset($arr[$next_key]);
            }
        }

        return $arr;
    }
} // if (! function_exists('clearEmptyArrayItems')) {

if ( ! function_exists('concatArray')) {
    function concatArray(
        $arr,
        $splitter = ',',
        $skip_empty = true,
        $skip_last_delimiter = true
    ) {
        $ret_str = '';

        if ( ! is_array($arr) or empty($arr)) {
            return '';
        }
        $l              = count($arr);
        $nonempty_array = array();
        for ($i = 0; $i < $l; $i++) {
            $next_value = trim($arr[$i]);
            if (empty($next_value) and $skip_empty) {
                continue;
            }
            $nonempty_array[] = removeMore1Space($next_value);
        }

        $l = count($nonempty_array);
        for ($i = 0; $i < $l; $i++) {
            $next_value = trim($nonempty_array[$i]);
            $ret_str    .= $next_value . (($skip_last_delimiter and $i == $l - 1) ? '' : $splitter);
        }

        return $ret_str;
    }
} // if (! function_exists('concatArray')) {

if ( ! function_exists('concatConditionalValues')) {
    function concatConditionalValues(
        $valuesArray,
        $splitter = '',
        $default_value = ''
    ) {
        $ret         = '';
        $have_values = false;
//        echo '<pre>$valuesArray::'.print_r($valuesArray,true).'</pre>';
        foreach ($valuesArray as $next_key => $next_value) {
            if ($next_value['condition']) {
                $have_values = true;
                $ret         .= $next_value['value'] . $splitter;
            }
        }
        if (empty($have_values)) {
            $ret = $default_value;
        }
        $ret = trimRightSubString($ret, $splitter);

        return $ret;
    }
} // if (! function_exists('concatConditionalValues')) {

if ( ! function_exists('removeMore1Space')) {
    function removeMore1Space($str)
    {
        $res = preg_replace('/\s\s+/', ' ', $str);

        return $res;
    }
} // if (! function_exists('removeMore1Space')) {

if ( ! function_exists('getRightSubstring')) {
    function getRightSubstring(string $S, $count): string
    {
        return substr($S, strlen($S) - $count, $count);
    }
} // if (! function_exists('getRightSubstring')) {



if ( ! function_exists('getCFPriceFormat')) {
    function getCFPriceFormat($value)
    {
        return number_format($value, 2, ',', '.');
    }
} // if (! function_exists('getCFPriceFormat')) {


if ( ! function_exists('cFWriteArrayToCsvFile')) {
    function cFWriteArrayToCsvFile(array $dataArray, string $filename, array $directoriesArray): int
    {
        createDir($directoriesArray);
        $path = $directoriesArray[count($directoriesArray) - 1];
        \Excel::create($filename, function ($excel) use ($dataArray) {
            $excel->sheet('file', function ($sheet) use ($dataArray) {
                $sheet->fromArray($dataArray);
            });
        })->store('csv', $path);

        return 1;
    }
} // if (! function_exists('cFWriteArrayToCsvFile')) {


if ( ! function_exists('getCFFileSizeAsString')) {
    function getCFFileSizeAsString(string $file_size): string
    {
        if ((int)$file_size < 1024) {
            return $file_size . 'b';
        }
        if ((int)$file_size < 1024 * 1024) {
            return floor($file_size / 1024) . 'kb';
        }

        return floor($file_size / (1024 * 1024)) . 'mb';
    }
} // if (! function_exists('getCFFileSizeAsString')) {


if ( ! function_exists('getSystemInfo')) {
    function getSystemInfo()
    {

        $DB_CONNECTION = config('database.default');
        $connections   = config('database.connections');
        $database_name = ! empty($connections[$DB_CONNECTION]['database']) ? $connections[$DB_CONNECTION]['database'] : '';

        $pdo           = DB::connection()->getPdo();
        $db_version    = $pdo->query('select version()')->fetchColumn();
        $tables_prefix = DB::getTablePrefix();

        $newsLetterApiArray  = (array)\Newsletter::getApi();
        $mail_chimp_api_text = '';
        foreach ($newsLetterApiArray as $next_key => $next_value) {
            if (strpos($next_key, 'api_endpoint') > 0) {
                $mail_chimp_api_text = 'Mail Chimp API : <strong>' . $next_value . '</strong>';
                break;
            }
        }

        ob_start();
        phpinfo();
        $phpinfo_str = ob_get_contents() . '<hr><pre>' . print_r($_SERVER, true) . '</pre>';
        ob_end_clean();
        $server_info = '<hr><pre>' . print_r($_SERVER, true) . '</pre>';

        $app_version = '';
        if (file_exists(public_path('app_version.txt'))) {
            $app_version = File::get('app_version.txt');
            if ( ! empty($app_version)) {
                $app_version = ' app_version : <b> ' . $app_version . '</b><br>';
            }
        }

        $is_running_under_docker_text = '';
        if (isRunningUnderDocker()) {
            $is_running_under_docker_text = '<b>Running Under Docker</b><br>';
        }

        $runningUnderDocker = (isRunningUnderDocker() ? '<strong>UnderDocker</strong>' : 'No Docker');
        $string             = ' Laravel:<b>' . app()::VERSION . '</b><br>' .
                              'PHP:<b>' . phpversion() . '</b><br>' .
                              'DEBUG:<b>' . config('app.debug') . '</b><br>' .
                              'PHP SAPI NAME:<b>' . php_sapi_name() . '</b><br>' .
                              'ENV:<b>' . config('app.env') . '</b><br>' .
                              'DB CONNECTION:<b> ' . $DB_CONNECTION . ' </b><br>' .
                              'DB VERSION:<b> ' . $db_version . '</b><br>' .
                              'DB DATABASE:<b> ' . $database_name . '</b><br>' .
                              'TABLES PREFIX:<b> ' . $tables_prefix . '</b><br>' .

                              '<hr>' .
                              'base_path:<b>' . base_path() . '</b><br>' .
                              'app_path:<b>' . app_path() . '</b><br>' .
                              'public_path:<b>' . public_path() . '</b><br>' .
                              'storage_path:<b>' . storage_path() . '</b><br>' .
                              'Path to the \'storage/app\' folder:<b>' . storage_path('app') . '</b><br>' .
                              $app_version .
                              $is_running_under_docker_text .
                              '<hr>' .

                              $mail_chimp_api_text . '</b><br>' .
                              '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:300px; max-width:600px;">' . $phpinfo_str . '</div></div>' .
                              '<hr><div>' . $runningUnderDocker . '</div>' .
                              '<hr><div> <div style="overflow-x:scroll; overflow-y:scroll; max-height:300px; max-width:600px;">' . $server_info . '</div></div>';

        return $string;
    }
} // if (! function_exists('getSystemInfo')) {

if ( ! function_exists('isPositiveNumeric')) {
    function isPositiveNumeric(int $str): bool
    {
        if (empty($str)) {
            return false;
        }

        return (is_numeric($str) && $str > 0 && $str == round($str));
    }
} // if (! function_exists('isPositiveNumeric')) {

if ( ! function_exists('replaceSpaces')) {
    function replaceSpaces($S)
    {
        $Pattern = '/([\s])/xsi';
        $S       = preg_replace($Pattern, '&nbsp;', $S);

        return $S;
    }
} // if (! function_exists('replaceSpaces')) {

if ( ! function_exists('createDir')) {
    function createDir(array $directoriesList = [], $mode = 0777)
    {
        foreach ($directoriesList as $dir) {
            if ( ! file_exists($dir)) {
                mkdir($dir, $mode);
            }
        }
    }
} // if (! function_exists('createDir')) {

if ( ! function_exists('deleteEmptyDirectory')) {
    function deleteEmptyDirectory(string $directory_name)
    {
        if ( ! file_exists($directory_name) or ! is_dir($directory_name)) {
            return true;
        }
        $H = OpenDir($directory_name);
        while ($nextFile = readdir($H)) { // All files in dir
            if ($nextFile == "." or $nextFile == "..") {
                continue;
            }
            closedir($H);

            return false; // if there are files can not delete files
        }
        closedir($H);

        return rmdir($directory_name);
    }

} // if (! function_exists('deleteEmptyDirectory')) {

if ( ! function_exists('deleteDirectory')) {
    function deleteDirectory(
        string $directory_name
    ) {
        if ( ! file_exists($directory_name) or ! is_dir($directory_name)) {
            return true;
        }

        $H = OpenDir($directory_name);
        while ($nextFile = readdir($H)) { // All files in dir
            if ($nextFile == "." or $nextFile == "..") {
                continue;
            }
            unlink($directory_name . DIRECTORY_SEPARATOR . $nextFile);
        }
        closedir($H);

        return rmdir($directory_name);
    }
} // if (! function_exists('deleteDirectory')) {

if ( ! function_exists('pregSplit')) {
    function pregSplit(
        string $splitter,
        string $string_items,
        bool $skip_empty = true,
        $to_lower = false
    ): array {
        $retArray = [];
        $a        = preg_split(($splitter), $string_items);
        foreach ($a as $next_key => $next_value) {
            if ($skip_empty and ( ! isset($next_value) or empty($next_value))) {
                continue;
            }
            $retArray[] = ($to_lower ? strtolower(trim($next_value)) : trim($next_value));
        }

        return $retArray;
    }

} // if (! function_exists('pregSplit')) {


if ( ! function_exists('makeClearDoubledSpaces')) {
    function makeClearDoubledSpaces(string $str): string
    {
        return preg_replace("/(\s{2,})/ms", " ", $str);
    }
} // if (! function_exists('makeClearDoubledSpaces')) {


if ( ! function_exists('getLastTokenItem')) {
    function getLastTokenItem($str, $splitter = "\\"): string
    {
        $A = preg_split("/" . preg_quote($splitter) . "/", $str);
        if ( ! is_array($A)) {
            return '';
        }
        if (count($A) >= 1) {
            return $A[count($A) - 1];
        }

        return '';
    }
} // if (! function_exists('getLastTokenItem')) {

if ( ! function_exists('getAppVersion')) {
    function getAppVersion()
    {
        return '1.0.1';
    }
} // if (! function_exists('getAppVersion')) {
