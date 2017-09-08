<?php
  // set some variables
     /*
$host = "127.0.0.1";
$port = 25003;
// don't timeout!
set_time_limit(0);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

// accept incoming connections
// spawn another socket to handle communication
$output="";
$i;

while(true)
     {
        $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
        $clients[] = $spawn;
        
        // read client input
        $input = socket_read($spawn, 1024) or die("Could not read input\n");
        // clean up input string
        $input = trim($input);
        echo "Client Message : ".$input;
        // reverse client input and send back
        $output =$output.strrev($input) ."-".$i. "<br/>";
        socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
        $i++;
        // close sockets
     }

//socket_close($spawn);
socket_close($socket);
                          */
?>
   
   <?php
    
    $port = 25003;
    $host = "127.0.0.1";   
    
    // create a streaming socket, of type TCP/IP
    $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    
    // set the option to reuse the port
    socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);
    
    // "bind" the socket to the address to "localhost", on port $port
    // so this means that all connections on this port are now our resposibility to send/recv data, disconnect, etc..
    socket_bind($sock,$host, $port);
    
    // start listen for connections
    socket_listen($sock);

    // create a list of all the clients that will be connected to us..
    // add the listening socket to this list
    $clients = array($sock);
    
    while (true) {
        // create a copy, so $clients doesn't get modified by socket_select()
        $read = $clients;
        
        // get a list of all the clients that have data to be read from
        // if there are no clients with data, go to next iteration
        if (@socket_select($read, $write = NULL, $except = NULL, 0) < 1)
            continue;
        
        // check if there is a client trying to connect
        if (in_array($sock, $read)) {
            // accept the client, and add him to the $clients array
            $clients[] = $newsock = socket_accept($sock);
            
            // send the client a welcome message
            @socket_write($newsock, "no noobs, but ill make an exception :)\n".
            "There are ".(count($clients) - 1)." client(s) connected to the server\n");
            
            @socket_getpeername($newsock, $ip);
            echo "New client connected: {$ip}\n";
            
           
            // remove the listening socket from the clients-with-data array
            $key = array_search($sock, $read);
            unset($read[$key]);
        }
        
        // loop through all the clients that have data to read from
        foreach ($read as $read_sock) {
            // read until newline or 1024 bytes
            // socket_read while show errors when the client is disconnected, so silence the error messages
            $data = @socket_read($read_sock, 1024, PHP_NORMAL_READ);
            
            // check if the client is disconnected
            if ($data === false) {
                // remove client for $clients array
                $key = array_search($read_sock, $clients);
                unset($clients[$key]);
                echo "client disconnected.\n";
                // continue to the next client to read from, if any
                continue;
            }
            
            // trim off the trailing/beginning white spaces
            $data = trim($data);
            
            // check if there is any data after trimming off the spaces
            if (!empty($data)) {
            
                // send this to all the clients in the $clients array (except the first one, which is a listening socket)
                foreach ($clients as $send_sock) {
                
                    // if its the listening sock or the client that we got the message from, go to the next one in the list
                    if ($send_sock == $sock || $send_sock == $read_sock)
                        continue;
                    
                    // write the message to the client -- add a newline character to the end of the message
                    socket_write($send_sock, $data."\n");
                    
                } // end of broadcast foreach
                
            }
            
        } // end of reading foreach
    }

    // close the listening socket
    socket_close($sock);
?>
