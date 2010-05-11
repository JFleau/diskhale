<?  

 
$db='dhc'; 

// Connection

$mysql_host='gwennoz';
$mysql_user='dhc';
$mysql_bdd=$db;
$mysql_pswd='klassik';
$mysql_link = mysql_connect($mysql_host,$mysql_user,$mysql_pswd);
if (!$mysql_link) {echo 'Impossible de se connecter';exit('');}
mysql_select_db($mysql_bdd) or exit('Impossible de sélectionner la db');


 
// Script

$mois=date("m"); 
$filename="/home/binets/dhc/sauvegarde/sauve-".$mois.".sql"; 
$fp=fopen($filename, 'w'); 
fwrite($fp,"# sauvegarde du ".date("d-m-y")."\n") or die("Impossible de sauvegarder !"); 

 
$lang='fr'; 
 
 
/** 
 * Formats the INSERT statements depending on the target (screen/file) of the 
 * sql dump 
 *20 
 * @param   string  the insert statement 
 * 
 * @global  string  the buffer containing formatted strings 
 */ 


function PMA_myHandler($sql_insert) 
{ 
    global $tmp_buffer; 
 
    // Kanji encoding convert feature appended by Y.Kawada (2001/2/21) 
/*30*/    if (function_exists('PMA_kanji_str_conv')) { 
        $sql_insert = PMA_kanji_str_conv($sql_insert, $GLOBALS['knjenc'], isset($GLOBALS['xkana']) ? $GLOBALS['xkana'] : ''); 
    } 
    // Defines the end of line delimiter to use 
    $eol_dlm = (isset($GLOBALS['extended_ins']) && ($GLOBALS['current_row'] < $GLOBALS['rows_cnt'])) 
             ? ',' 
             : ';'; 
    // Result has no to be displayed on screen 
 
 
/*40*/     
    // Result has to be saved in a text file 
 
 
 
 
 
        $tmp_buffer .= $sql_insert . $eol_dlm . $GLOBALS['crlf']; 
}
 // end of the 'PMA_myHandler()' function 




 
 
/** 
 * Get the variables sent or posted to this script and a core script 
 */ 
if (!defined('PMA_GRAB_GLOBALS_INCLUDED')) { 
    define('PMA_GRAB_GLOBALS_INCLUDED', 1); 
 
    if (!empty($_GET)) { 
        extract($_GET); 
    } else if (!empty($HTTP_GET_VARS)) { 
        extract($HTTP_GET_VARS); 
    } // end if 
 
    if (!empty($_POST)) { 
        extract($_POST); 
    } else if (!empty($HTTP_POST_VARS)) { 
        extract($HTTP_POST_VARS); 
    } // end if 
 
    if (!empty($_FILES)) { 
        while (list($name, $value) = each($_FILES)) { 
            $$name = $value['tmp_name']; 
        } 
   } else if (!empty($HTTP_POST_FILES)) { 
        while (list($name, $value) = each($HTTP_POST_FILES)) { 
            $$name = $value['tmp_name']; 
        } 
    } // end if 
 
} // $__PMA_GRAB_GLOBALS_LIB__ 
 
    /** 
     * Defines the <CR><LF> value depending on the user OS. 
     * 
     * @return  string   the <CR><LF> value to use 
     * 
     * @access  public 
     */ 
    function PMA_whichCrlf() 
    { 
        $the_crlf = "\n"; 
 
        // The 'PMA_USR_OS' constant is defined in "./libraries/defines.lib.php" 
        // Win case 
        if (PMA_USR_OS == 'Win') { 
            $the_crlf = "\r\n"; 
        } 
        // Mac case 
/*100*/        else if (PMA_USR_OS == 'Mac') { 
            $the_crlf = "\r"; 
        } 
        // Others 
        else { 
            $the_crlf = "\n"; 
        } 
 
        return $the_crlf; 
    } // end of the 'PMA_whichCrlf()' function 
 
    /** 
     * Writes localised date 
     * 
     * @param   string   the current timestamp 
     * 
     * @return  string   the formatted date 
     * 
     * @access  public 
     */ 
    function PMA_localisedDate($timestamp = -1) 
    { 
        global $datefmt, $month, $day_of_week; 
 
        if ($timestamp == -1) { 
/*125*/            $timestamp = time(); 
        } 
 
        $date = ereg_replace('%[aA]', $day_of_week[(int)strftime('%w', $timestamp)], $datefmt); 
        $date = ereg_replace('%[bB]', $month[(int)strftime('%m', $timestamp)-1], $date); 
 
        return strftime($date, $timestamp); 
    } // end of the 'PMA_localisedDate()' function 
 
    function PMA_sqlAddslashes($a_string = '', $is_like = FALSE) 
    { 
        if ($is_like) { 
            $a_string = str_replace('\\', '\\\\\\\\', $a_string); 
        } else { 
            $a_string = str_replace('\\', '\\\\', $a_string); 
        } 
        $a_string = str_replace('\'', '\\\'', $a_string); 
 
        return $a_string; 
    } // end of the 'PMA_sqlAddslashes()' function 
 
 
    function PMA_getTableContent($db, $table, $add_query = '', $handler, $error_url) 
    { 
        global $rows_cnt; 
        global $current_row; 
 
        $local_query  = 'SELECT * FROM `' . $db . '`.`' . $table .'` '. $add_query; 
        $result       = mysql_query($local_query) or die($local_query); 
        $current_row  = 0; 
        $fields_cnt   = mysql_num_fields($result); 
        $rows_cnt     = mysql_num_rows($result); 
 
        @set_time_limit($GLOBALS['cfgExecTimeLimit']); // HaRa 
 
        // loic1: send a fake header to bypass browser timeout if data 
        //        are bufferized - part 1 
        if (!empty($GLOBALS['ob_mode']) 
            || (isset($GLOBALS['zip']) || isset($GLOBALS['bzip']) || isset($GLOBALS['gzip']))) { 
            $time0    = time(); 
        } 
 
        while ($row = mysql_fetch_row($result)) { 
            $current_row++; 
            $table_list     = '('; 
            for ($j = 0; $j < $fields_cnt; $j++) { 
                $table_list .= mysql_field_name($result, $j) . ', '; 
            } 
            $table_list     = substr($table_list, 0, -2); 
            $table_list     .= ')'; 
 
            if (isset($GLOBALS['extended_ins']) && $current_row > 1) { 
                $schema_insert = '('; 
            } else { 
                if (isset($GLOBALS['showcolumns'])) { 
                    $schema_insert = 'INSERT INTO ' . $table 
                                   . ' ' . $table_list . ' VALUES ('; 
                } else { 
                    $schema_insert = 'INSERT INTO ' . $table 
                                   . ' VALUES ('; 
                } 
                $is_first_row      = FALSE; 
            } 
 
            for ($j = 0; $j < $fields_cnt; $j++) { 
                if (!isset($row[$j])) { 
                    $schema_insert .= ' NULL, '; 
                } else if ($row[$j] == '0' || $row[$j] != '') { 
                    $type          = mysql_field_type($result, $j); 
                    // a number 
                    if ($type == 'tinyint' || $type == 'smallint' || $type == 'mediumint' || $type == 'int' || 
                        $type == 'bigint'  ||$type == 'timestamp') { 
                        $schema_insert .= $row[$j] . ', '; 
                    } 
                    // a string 
                    else { 
                        $dummy  = ''; 
                        $srcstr = $row[$j]; 
                        for ($xx = 0; $xx < strlen($srcstr); $xx++) { 
                            $yy = strlen($dummy); 
                            if ($srcstr[$xx] == '\\')   $dummy .= '\\\\'; 
                            if ($srcstr[$xx] == '\'')   $dummy .= '\\\''; 
//                            if ($srcstr[$xx] == '"')    $dummy .= '\\"'; 
                            if ($srcstr[$xx] == "\x00") $dummy .= '\0'; 
                            if ($srcstr[$xx] == "\x0a") $dummy .= '\n'; 
                            if ($srcstr[$xx] == "\x0d") $dummy .= '\r'; 
//                            if ($srcstr[$xx] == "\x08") $dummy .= '\b'; 
//                            if ($srcstr[$xx] == "\t")   $dummy .= '\t'; 
                            if ($srcstr[$xx] == "\x1a") $dummy .= '\Z'; 
                            if (strlen($dummy) == $yy)  $dummy .= $srcstr[$xx]; 
                        } 
                        $schema_insert .= "'" . $dummy . "', "; 
                    } 
                } else { 
                    $schema_insert .= "'', "; 
                } // end if 
            } // end for 
            $schema_insert = ereg_replace(', $', '', $schema_insert); 
            $schema_insert .= ')'; 
            $handler(trim($schema_insert)); 
 
            // loic1: send a fake header to bypass browser timeout if data 
            //        are bufferized - part 2 
            if (isset($time0)) { 
                $time1 = time(); 
                if ($time1 >= $time0 + 30) { 
                    $time0 = $time1; 
                    header('X-pmaPing: Pong'); 
                } 
            } // end if 
        } // end while 
        mysql_free_result($result); 
 
        return TRUE; 
    } // end of the 'PMA_getTableContent()' function 
 
    /** 
     * Returns $table's CREATE definition 
     * 
     * Uses the 'PMA_htmlFormat()' function defined in 'tbl_dump.php' 
     * 
     * @param   string   the database name 
     * @param   string   the table name 
     * @param   string   the end of line sequence 
     * @param   string   the url to go back in case of error 
     * 
     * @return  string   the CREATE statement on success 
     * 
     * @global  boolean  whether to add 'drop' statements or not 
     * @global  boolean  whether to use backquotes to allow the use of special 
     *                   characters in database, table and fields names or not 
     * 
     * @see     PMA_htmlFormat() 
     * 
     * @access  public 
     */ 
    function PMA_getTableDef($db, $table, $crlf, $error_url) 
    { 
        global $drop; 
        global $use_backquotes; 
 
        $schema_create = ''; 
        if (!empty($drop)) { 
            $schema_create .= 'DROP TABLE IF EXISTS ' . $table . ';' . $crlf; 
        } 
 
        // Steve Alberty's patch for complete table dump, 
        // modified by Lem9 to allow older MySQL versions to continue to work 
        if (PMA_MYSQL_INT_VERSION >= 32321) { 
            // Whether to quote table and fields names or not 
            if ($use_backquotes) { 
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 1'); 
            } else { 
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 0'); 
            } 
            $result = mysql_query('SHOW CREATE TABLE `' . $db . '`.' .$table); 
            if ($result != FALSE && mysql_num_rows($result) > 0) { 
                $tmpres        = mysql_fetch_array($result); 
                $schema_create .= str_replace("\n", $crlf, $tmpres[1]); 
            } 
            mysql_free_result($result); 
            return $schema_create; 
        } // end if MySQL >= 3.23.20 
 
        // For MySQL < 3.23.20 
        $schema_create .= 'CREATE TABLE ' . $table. ' (' . $crlf; 
 
        $local_query   = 'SHOW FIELDS FROM `' . $db . '`.' . $table; 
        $result        = mysql_query($local_query) or die($local_query.$table); 
        while ($row = mysql_fetch_array($result)) { 
            $schema_create     .= '   ' . $row['Field'] . ' ' . $row['Type']; 
            if (isset($row['Default']) && $row['Default'] != '') { 
                $schema_create .= ' DEFAULT \'' . PMA_sqlAddslashes($row['Default']) . '\''; 
            } 
            if ($row['Null'] != 'YES') { 
                $schema_create .= ' NOT NULL'; 
            } 
            if ($row['Extra'] != '') { 
                $schema_create .= ' ' . $row['Extra']; 
            } 
            $schema_create     .= ',' . $crlf; 
        } // end while 
        mysql_free_result($result); 
        $schema_create         = ereg_replace(',' . $crlf . '$', '', $schema_create); 
 
        $local_query = 'SHOW KEYS FROM `' . $db . '`.' . $table; 
        $result      = mysql_query($local_query) or die($local_query); 
        while ($row = mysql_fetch_array($result)) 
        { 
            $kname    = $row['Key_name']; 
            $comment  = (isset($row['Comment'])) ? $row['Comment'] : ''; 
            $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : ''; 
 
            if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) { 
                $kname = "UNIQUE|$kname"; 
            } 
            if ($comment == 'FULLTEXT') { 
                $kname = 'FULLTEXT|$kname'; 
            } 
            if (!isset($index[$kname])) { 
                $index[$kname] = array(); 
            } 
            if ($sub_part > 1) { 
                $index[$kname][] = $row['Column_name'] . '(' . $sub_part . ')'; 
            } else { 
                $index[$kname][] = $row['Column_name']; 
            } 
        } // end while 
        mysql_free_result($result); 
 
        while (list($x, $columns) = @each($index)) { 
            $schema_create     .= ',' . $crlf; 
            if ($x == 'PRIMARY') { 
                $schema_create .= '   PRIMARY KEY ('; 
            } else if (substr($x, 0, 6) == 'UNIQUE') { 
                $schema_create .= '   UNIQUE ' . substr($x, 7) . ' ('; 
            } else if (substr($x, 0, 8) == 'FULLTEXT') { 
                $schema_create .= '   FULLTEXT ' . substr($x, 9) . ' ('; 
            } else { 
                $schema_create .= '   KEY ' . $x . ' ('; 
            } 
            $schema_create     .= implode($columns, ', ') . ')'; 
        } // end while 
 
        $schema_create .= $crlf . ')'; 
 
        return $schema_create; 
    } // end of the 'PMA_getTableDef()' function 
 
 
 
/* 
require('.\libraries\common.lib.php'); 
require('.\libraries\build_dump.lib.php'); */ 
 
/** 
 * Defines the url to return to in case of error in a sql statement 
 */ 
$err_url = 'beuh'; 
 
/** 
 * Increase time limit for script execution and initializes some variables 
 */ 
$dump_buffer = ''; 
// Defines the default <CR><LF> format 
$crlf        = PMA_whichCrlf(); 
 
 
/** 
 * Builds the dump 
 */ 
// Gets the number of tables if a dump of a database has been required 
    $tables     = mysql_list_tables($db); 
    $num_tables = @mysql_numrows($tables); 
 
// No table -> error message 
if ($num_tables == 0) { 
    echo '# Aucune table trouvée'; exit;
} 
// At least on table -> do the work 
else { 
        $dump_buffer       .= '# phpMyAdmin MySQL-Dump' . $crlf 
                           .  '# version ' . PMA_VERSION . $crlf 
                           .  '# http://phpwizard.net/phpMyAdmin/' . $crlf 
                           .  '# http://www.phpmyadmin.net/ (download page)' . $crlf 
                           .  '#' . $crlf 
                           .  '# ' . $strHost . ': ' . $cfgServer['host']; 
        if (!empty($cfgServer['port'])) { 
            $dump_buffer   .= ':' . $cfgServer['port']; 
        } 
        $formatted_db_name = '\'' . $db . '\''; 
        $dump_buffer       .= $crlf 
                           .  '# ' . $strGenTime . ': ' . PMA_localisedDate() . $crlf 
                           .  '# ' . $strServerVersion . ': ' . substr(PMA_MYSQL_INT_VERSION, 0, 1) . '.' . substr(PMA_MYSQL_INT_VERSION, 1, 2) . '.' . substr(PMA_MYSQL_INT_VERSION, 3) . $crlf 
                           .  '# ' . $strPHPVersion . ': ' . phpversion() . $crlf 
                           .  '# ' . $strDatabase . ': ' . $formatted_db_name . $crlf; 
 
        $i = 0; 
        if (isset($table_select)) { 
            $tmp_select = implode($table_select, '|'); 
            $tmp_select = '|' . $tmp_select . '|'; 
        } 
        while ($i < $num_tables) { 
                $table = mysql_tablename($tables, $i); 
                $formatted_table_name = '\'' . $table . '\''; 
                $dump_buffer .= '# --------------------------------------------------------' . $crlf 
                                 .  $crlf . '#' . $crlf 
                                 .  '# ' . $strTableStructure . ' ' . $formatted_table_name . $crlf 
                                 .  '#' . $crlf . $crlf 
                                 .  PMA_getTableDef($db, $table, $crlf, $err_url) . ';' . $crlf; 
                if (function_exists('PMA_kanji_str_conv')) { // Y.Kawada 
                    $dump_buffer = PMA_kanji_str_conv($dump_buffer, $knjenc, isset($xkana) ? $xkana : ''); 
                } 
                $tcmt = $crlf . '#' . $crlf 
                              .  '# ' . $strDumpingData . ' ' . $formatted_table_name . $crlf 
                              .  '#' . $crlf .$crlf; 
                if (function_exists('PMA_kanji_str_conv')) { // Y.Kawada 
                        $dump_buffer .= PMA_kanji_str_conv($tcmt, $knjenc, isset($xkana) ? $xkana : ''); 
                } else { 
                        $dump_buffer .= $tcmt; 
                } 
                $tmp_buffer  = ''; 
                if (!isset($limit_from) || !isset($limit_to)) { 
                        $limit_from = $limit_to = 0; 
                } 
                PMA_getTableContent($db, $table, '', 'PMA_myHandler', $err_url); 
 
                $dump_buffer .= $tmp_buffer; 
                $i++; 
        } // end while 
 
        // staybyte: don't remove, it makes easier to select & copy from 
        // browser 
        $dump_buffer .= $crlf; 
 
 } // end building the dump 
 
 
    fwrite($fp,$dump_buffer); 
 
	echo "Base de donnée sauvegardée";  

// Fin

	mysql_close();

