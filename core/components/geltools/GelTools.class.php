<?php
/**
 * GEL Studios General helper tools
 *
 * PHP version 5.6
 *
 * @package    GEL Tools
 * @author     GEL Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 */

class GelTools
{


    /**
     * Displays a pretty dump of the var
     *
     * @param mixed[] $var the item to be output
     * @param bool $return (optional) by default this function will print output
     * @param array $arrayOfObjectsToHide (optional) items you don't want to display
     * @param int $fontSize (optional) override font size
     * @return string the output
     */
    public static function dump($var, $return = false, $arrayOfObjectsToHide = null, $fontSize = 11)
    {

        if (is_array($arrayOfObjectsToHide)) {

            foreach ($arrayOfObjectsToHide as $objectName) {

                $searchPattern = '#(' . $objectName . ' Object\n(\s+)\().*?\n\2\)\n#s';
                $replace = "$1<span style=\"color: #FF9900;\">--&gt; HIDDEN - courtesy of wtf() &lt;--</span>)";
                $var = preg_replace($searchPattern, $replace, $var);
            }
        }

        // color code objects
        $var = preg_replace('#(\w+)(\s+Object\s+\()#s', '<span style="color: #079700;">$1</span>$2', $var);
        // color code object properties
        $var = preg_replace('#\[(\w+)\:(public|private|protected)\]#', '[<span style="color: #000099;">$1</span>:<span style="color: #009999;">$2</span>]', $var);

        if($return == true) return '<pre style="font-size: ' . $fontSize . 'px; line-height: ' . $fontSize . 'px;">' . $var . '</pre>';
        echo '<pre style="font-size: ' . $fontSize . 'px; line-height: ' . $fontSize . 'px;">' . $var . '</pre>';
    }

    /**
     * converts seconds to readable hours, mins and secs format
     *
     * @param int $seconds the seconds to convert
     * @return string the formatted time
     */
    public static function formatSeconds($seconds) {

        if(!is_numeric($seconds)) $seconds = 0;

        $hours = gmdate("H", $seconds );
        $mins = gmdate("i", $seconds );
        $secs = gmdate("s", $seconds );

        $string = null;

        if($hours > 0) {
            $hours = intval($hours);
            $string .= $hours."h ";
        }

        if($mins > 0) {
            $mins = intval($mins);
            $string .= $mins."min ";
        }

        if($secs > 0) {
            $secs = intval($secs);
            $string .= $secs."sec ";
        }

        return $string;
    }

    /**
     * converts string to URL safe format
     *
     * @param string $text the string to convert
     * @return string the slug
     */
    public static function slugify($text) {

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * converts filename to URL safe format and retains the extension
     *
     * @throws Exception if the extension is unclear
     * @param string $text the string to convert
     * @param bool $addTimeStamp (optional) adds a timestamp to ensure unique
     * @return string the formatted filename
     */
    public static function slugifyKeepExt($text, $addTimeStamp=false) {

        $bits=explode(".", $text);

        if(count($bits)!=2) throw new Exception("File extension is not clear from filename!");

        if($addTimeStamp) return self::slugify($bits[0])."_".time().".".$bits[1];
        return self::slugify($bits[0]).".".$bits[1];
    }

    /**
     * generates a random alpha-numeric string
     *
     * @param int $length (optional) length of random string to return
     * @return string the random string
     */
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * converts line breaks to HTML paragraphs
     *
     * @param string $string the string to convert
     * @return string the formatted HTML text
     */
    public static function nl2p($string) {
        $string = self::normalizeLineEndings($string);
        return "<p>".str_replace("\n", "</p><p>", $string)."</p>";
    }

    /**
     * converts all line ending to consistent format
     *
     * @param string $string the string to convert
     * @return string the clean text
     */
    public static function normalizeLineEndings($string) {
        $string = str_replace("\r\n", "\n", $string);
        $string = str_replace("\r", "\n", $string);
        $string = preg_replace("/\n{2,}/", "\n", $string);
        return $string;
    }

    /**
     * shorten a string to a limit for summaries etc
     *
     * @param string $text the string to shorten
     * @param int $length (optional) the length of the output
     * @return string the shortened text
     */
    public static function truncate($text, $length=50) {
        $length = abs((int)$length);
        if(strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return($text);
    }

    /**
     * shorten a string to a limit (whole words only) for summaries etc
     *
     * @param string $text the string to shorten
     * @param int $limit (optional) the length of the output
     * @param string $ellipses (optional) the ellipses to append the string
     * @return string the shortened text
     */
    public static function truncateWords($text, $limit = 50, $ellipses='...') {

        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . $ellipses;
        }
        return $text;
    }

    /**
     * minify JS
     *
     * @param string $js the js code to minify
     * @return string the minifed code
     */
    public static function minifyJs($js) {
        return Minify::minify_js($js);
    }


}