<?php
  try
{
    require_once('ShopConfig.php');
    require_once('/home/traodoidi/domains/traodoidi.vn/public_html/swap_api/shop/ShopDAO.php');
    require_once("/home/traodoidi/domains/traodoidi.vn/public_html/swap_api/function/utils.php");   
    ini_set('display_errors', 'on');
    $mode="development";
    $config = $config[$mode];
    $obj = new Shop_Notify_Push_Queue($config);
    $obj->start();
}
catch (Exception $e)
{
    fatalError($e);
}

function writeToLog($message)
{
    global $config;
    if ($fp = fopen($config['logPushQueue'], 'at'))
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
class Shop_Notify_Push_Queue
{
    private $fp = NULL;
    private $server;
    private $config;

    function __construct($config)
    {
        $this->server = $config['server'];
        $this->config = $config;
      
    }
    
    function connectDB(){
        
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
           $limit = 1000;
           while (true)
            {
                $listNotify = $this->getAllNotify();
                $i=1;
                foreach ($listNotify as $item)
                {
                    echo "---->Notify: ".$item["id"]."\n";
                     $i=1;
                    //Push Notify To Queue
                        $arrToken =  $this->getTokenSendFromUser($item["to_user"]);
                        foreach($arrToken as $token){
                            var_dump($token["device_token"]);
                              $payload = $this->createPayLoadNotify($item["id"],$item["content"],$item["object_type"],$item["object_id"],$item["from_user"],$item["to_user"],"");
                               if(!empty($payload))
                               $this->insertNotifyToQueue($item["id"],$token["device_token"],$payload,$token["os_type"]);
                        }
                        $i++;
                    $i=1;
                     $this->updateStatusNotifyQueue($item["id"]);
                     echo "-------------------\n";
                }
                unset($listNews);            
                sleep(5);
            }
    }

  
  function insertNotifyToQueue($notice_id,$device_token,$payload,$os_type)
    {   
        $count = 0;
       
        try{
            $connect = $this->connectDB();
            $sql = "INSERT INTO ms_notify_queue (notice_id, device_token, payload, time_queued, time_sent, os_type, channel) 
            VALUES(:notice_id,:device_token,:payload,NOW(),NOW(),:os_type,0);";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array(":notice_id"=>$notice_id,":device_token"=>$device_token,":payload"=>$payload,":os_type"=>$os_type);
            $count = $q->execute($arrV);
            $connect = null;
           
        }catch (Exception $e) {
          $count = 0;
        }
        
         return $count;   
    }  
   
    function updateStatusNotifyQueue($notify_id)
    {   
        try{
            $connect = $this->connectDB();
            $sql = "UPdate ms_notify  SET status = 0 WHERE id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($notify_id);
            $count = $q->execute($arrV);
            $connect = null;
        }catch (Exception $e) {
          $count = 0;
        }
        
        return $count;   
    }
    
   
   
    function getTokenSendFromUser($user_id)
    {
        $connect = $this->connectDB();
        $sql = "SELECT device_token,os_type,channel FROM ms_notify_user WHERE user_id =  ".$user_id;
        echo $sql;
            # creating the statement
            $q = $connect->prepare($sql);
            $q->execute(array());   
            
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();  
            $i = 0;  
            while($row = $q->fetch()) {
                 $arr[$i] =  $row;
                 $i++;
                
            }
            
            $connect = null;
            return $arr;   
       
    } 
    
   
  function getAllNotify()
    {
        $connect = $this->connectDB();
        $sql = "SELECT     id,object_id, to_user, from_user, content, icon,
        url, object_type, STATUS, time_sent, create_date, create_user 
        FROM ms_notify WHERE STATUS = 1 LIMIT 0, 50; ";
       
            # creating the statement
            $q = $connect->prepare($sql);
            $q->execute();   
            
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();  
            $i = 0;  
            while($row = $q->fetch()) {
                 $arr[$i] =  $row;
                 $i++;
            }
            
            $connect =  null;
            return $arr;   
       
    } 
      
    //Create Payload Notification
  function createPayLoadNotify($notify_id,$body,$object_type,$oid,$from_user,$to_user,$icon)
  {  //1: Product, 2: User, 3 Transaction; 4: Message; 5: Inform Event
     $arr_cdata = array();
     $arr_cdata["id"] = $notify_id;
     $arr_cdata["otype"] = $object_type;
     $arr_cdata["oid"] = $oid;
     $arr_cdata["fid"] = $from_user;
     $arr_cdata["icon"] = $icon;
     
     if($object_type==1){
         $product = getProductDetail($oid);
         $arr_cdata["cate_id"] = $product["cate_id"];
         $arr_cdata["lat"] = $product["lat"];
         $arr_cdata["lng"] = $product["lng"];
     }
     
     if($object_type==2){ 
        $arr_cdata["isFollowing"] = checkHasFollowing($to_user,$oid);    
     }
     
     if($object_type==3){ 
        $transaction = getTransaction($oid) ;
        $arr_cdata["transaction_type"] = $transaction["transaction_type"];
      }
      
     if($object_type==4){
         $product = getProductDetail($oid);
         $arr_cdata["title"] = $product["title"];
         $arr_cdata["create_user_id"] = $from_user;
         $user = getUserShop($from_user);
         $arr_cdata["create_user_name"] = $user["fullname"];
         $arr_cdata["create_user_avatar"] = $user["avatar_url"];   
     }
     
     $arr_alert = array();
     $arr_alert["body"] = $body;
     $arr_alert["cdata"] = $arr_cdata;
     
     $arr_aps = array();
     $arr_aps["alert"] = $arr_alert;
     $arr_aps["sound"] = "default";
     
     $arr_out = array();
     $arr_out["aps"] = $arr_aps;
      
     return json_encode($arr_out);
  }
}
?>