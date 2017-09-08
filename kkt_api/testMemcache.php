<?php
echo 1;
    $meminstance = new Memcache();
    $meminstance->pconnect('localhost', 11211);

    mysql_connect("localhost", "ustoregame", "pstoregame&*(") or die(mysql_error());
    mysql_select_db("vtc_game_store") or die(mysql_error());

    $query = "select id from g_game";
    $querykey = "KEY" . md5($query);

    $result = $meminstance->get($querykey);

    if (!$result) {
           $result = mysql_fetch_array(mysql_query($query)) or die('mysql error');
           $meminstance->set($querykey, $result, 0, 600);
            print "got result from mysql\n";
            return 0;
    }

    print "got result from memcached\n";
    var_dump($result);
    $meminstance->close();

    return 0;

?>