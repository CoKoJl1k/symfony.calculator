<?php


require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Установка соединения с RabbitMQ
$connection = new AMQPStreamConnection('rabbitmq-calc', 5672, 'rmuser', 'rmpassword');
$channel = $connection->channel();
// Создание очереди
$channel->queue_declare('hello', false, false, false, false);
$channel->queue_declare('hello2', false, false, false, false);
$channel->queue_declare('hello3', false, false, false, false);
$channel->queue_declare('hello4', false, false, false, false);
$channel->queue_declare('hello5', false, false, false, false);
// Обработка полученных сообщений
$callback = function ($msg) {
    echo "Received message: " . $msg->body . "\n";
};
// Указание получателю, как обрабатывать сообщения
$channel->basic_consume('hello', '', false, true, false, false, $callback);
$channel->basic_consume('hello2', '', false, true, false, false, $callback);
$channel->basic_consume('hello3', '', false, true, false, false, $callback);
$channel->basic_consume('hello4', '', false, true, false, false, $callback);
$channel->basic_consume('hello5', '', false, true, false, false, $callback);
// Запуск получателя
while ($channel->is_consuming()) {
    $channel->wait();
}

// Закрытие соединения
$channel->close();
$connection->close();