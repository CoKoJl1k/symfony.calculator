<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

echo ' start '.date('Y-m-d h:i:s').PHP_EOL;

$connection = new AMQPStreamConnection('rabbitmq-calc', 5672, 'rmuser', 'rmpassword');
$channel = $connection->channel();
// Создание очереди
$channel->queue_declare('hello', false, false, false, false);
$channel->queue_declare('hello2', false, false, false, false);
$channel->queue_declare('hello3', false, false, false, false);
$channel->queue_declare('hello4', false, false, false, false);
$channel->queue_declare('hello5', false, false, false, false);

$db = new PDO('mysql:dbname=test;host=db-calc', 'root', 'root');
$sql = "insert ignore into test_users (id,first_name) values ";  // insert
//$sql = "UPDATE test_users "; // update

$ids = '';
for ($i=0;$i<=100000;$i++) {
    $message = new AMQPMessage('Hello, RabbitMQ! ' .$i);

    if ($i%2 == 0) {
        $channel->basic_publish($message, '', 'hello');
    } elseif ($i%3 == 0){
        $channel->basic_publish($message, '', 'hello2');
    } elseif ($i%5 == 0) {
        $channel->basic_publish($message, '', 'hello3');
    } elseif ($i%7 == 0) {
        $channel->basic_publish($message, '', 'hello4');
    } else {
        $channel->basic_publish($message, '', 'hello5');
    }
    $sql .= " ($i,'first_name'),";  // insert
  //  $ids .= $i.',';  // update
}

//$ids = trim($ids,','); // update
//$sql .= " SET first_name = 'first_name_77' where id in ($ids)"; // update

$sql = trim($sql,',');  // insert

$stmt = $db->prepare($sql);
$stmt->execute();

// Закрытие соединения
$channel->close();
$connection->close();

echo ' end '.date('Y-m-d h:i:s').PHP_EOL;