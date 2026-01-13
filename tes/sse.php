<?php
header('Access-Control-Allow-Origin: http://localhost:3000');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

header('Access-Control-Allow-Credentials: true');

// Set file mime type event-stream
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = 0;

// Loop until the client close the stream
while (true) {

  // Echo time
  // $time = date('r');
  $time++;
  echo "data: {$time}\n\n";

  // Flush buffer (force sending data to client)
  flush();

  // Wait 2 seconds for the next message / event
  sleep(1);  
}
?>