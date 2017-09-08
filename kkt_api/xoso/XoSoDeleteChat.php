<?php
  try
{
    require_once('XosoAPNPushConfig.php');

    ini_set('display_errors', 'on');

    $mode="development";
    $config = $config[$mode];

    $obj = new Xoso_Delete_Chat($config);
   
    $obj->start();
}
catch (Exception $e)
{
    fatalError($e);
}

function writeToLog($message)
{
    global $config;
    if ($fp = fopen($config['logfile'], 'at'))
    {
        fwrite($fp, date('c') . ' ' . $message . PHP_EOL);
        fclose($fp);
    }
}

function fatalError($message)
{
    writeToLog('Exiting with fatal error: ' . $message);
    exit;
}

?>



<?php 
////////////////////////////////////////////////////////////////////////////////

class Xoso_Delete_Chat
{
    private $fp = NULL;
    private $server;
    private $certificate;
    private $passphrase;
    private $config;

    function __construct($config)
    {
        $this->server = $config['server'];
        $this->config = $config;
      
    }
    
    function connectGameStoreDB(){
        
        $this->server = $this->config['server'];
        // Create a connection to the database.
        $connect = new PDO(
            'mysql:host=' . $this->config['db']['host'] . ';dbname=' . $this->config['db']['dbname'], 
            $this->config['db']['username'], 
            $this->config['db']['password'],
            array());

        // If there is an error executing database queries, we want PDO to
        // throw an exception.
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // We want the database to handle all strings as UTF-8.
        $connect->query('SET NAMES utf8');
        return  $connect;
   }
   
    // This is the main loop for this script. It polls the database for new
    // messages, sends them to APNS, sleeps for a few seconds, and repeats this
    // forever (or until a fatal error occurs and the script exits).
    function start()
    {
       $this->deleteChat();
    }     
   
   
   function deleteChat()
    {   
        $count = 0;
        try{
            $connect = $this->connectGameStoreDB();
            $sql = " DELETE FROM xs_chat WHERE id_user IN (35197,32641,35451,35251,35144,35115,32418,33389,35169,35416,35722,34357,34424,35747,34535,36326,
            35821,35968,35866,35794,36016,28566,32699,35891,35975,35844,35966,34357,35144,36079,36119,36124,36114,36131,36167,36834,36659,36500,36667,30282,36382,36577,34691,36497,36902,36926,34321,
            37182,37121, 36977,37125,36951,37162,37134,37037,37443,37330,37245,37261,37420,37273,37584,37687,37555,32440,37536,37664,37949,37951,37687,34535
            ,37664,37687,37653,37687,38233,38291,39163,38504,39155) OR content = '' OR content LIKE '%MiÌnh ðang theo%' OR content LIKE '%quen bà chiò%' OR content LIKE '%bán sôì%'  
OR content LIKE '%kinh nghiêòm%' OR content LIKE '%vào zalo%' OR content LIKE '%soitanxuat.com%' OR content LIKE '%soicau88%' OR content LIKE '%zalo%' OR content LIKE '%soicauchuan%' OR content LIKE '%cauchuan%' OR content LIKE '%zl%' ";
            echo   $sql."\n";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array();
            $count = $q->execute($arrV);
            $connect = null;
           
        }catch (Exception $e) {
          $count = 0;
        }
         return $count;   
    }  
}

?>
