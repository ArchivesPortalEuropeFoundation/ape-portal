<?php
/**
 * GEL Studios Database helper tools
 *
 * PHP version 5.6
 *
 * @package    GEL Tools
 * @author     GEL Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 */

class GelDBTools
{

    /**
     * Ordered list of all unique tabs in a serialised delimited field
     *
     * @return array the unique tags in alpha order
     * @param string $table the database table to query
     * @param string $field the database field to query
     * @param string $separator the separator
     */
    public static function getUniqueTags($table, $field, $separator)
    {

    // grab all the unique vals and order by val name...
        $sql = "
        
        SELECT GROUP_CONCAT(DISTINCT TRIM(substring_index(substring_index(`" . $field . "`, ',', n.n), '" . $separator . "', -1)) SEPARATOR ',' ) as `values`
        FROM " . $table . " l
        CROSS JOIN (SELECT 1 AS n UNION ALL SELECT 2 ) n
        ORDER BY `values`;
        
        ";

        global $modx;
        $query = $modx->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // explode by ,
        $parts = explode(',', $result['values']);
        // knock of the first one, it's always blank
        array_shift($parts);
        $tags = $parts;
        return $tags;
    }

    /**
     * Converts the fields of a database object to array
     * for injecting into a chunk
     *
     * @return array field => value
     * @param object - the database object or result array (single depth)
     * @throws Exception if not an object
     */
    public static function tableToChunk($obj)
    {
        $response = array();
        if(is_object($obj)) { // @TODO - type check the object
            // @TODO - I think there's a mapping in the objects, so use that
        }
        return $response;
    }
}