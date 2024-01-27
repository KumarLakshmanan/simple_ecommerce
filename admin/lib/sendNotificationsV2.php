<?php
if (count($argv) < 3) {
    echo "Usage: php sendNotifications.php <data> <regid>\n";
    exit(1);
}
$data = json_decode($argv[1], true);
$regIdJson = json_decode(file_get_contents($argv[2]), true);
$logFile  = $argv[3];
$serverKey = 'AAAA2UFn85k:APA91bGul4JaKjNhqETgWEYMA0Jm2rm9Jv9GKEOfTP7yO_2nXi4RrAJX6j2miMfufcJtT0urZJLmHgWvHzQwKPVca1SgLMBqdJyMzN7BX3EX0WoFZ3vMDecXPQ7iig1GZZJ0bxv8CCgM';
$url = 'https://fcm.googleapis.com/fcm/send';

$headers = array(
    'Authorization: key=' . $serverKey,
    'Content-Type: application/json'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

foreach ($regIdJson as $key => $value) {
    $data['title'] = str_replace('{{firstname}}', $value['firstname'], $data['title']);
    $data['title'] = str_replace('{{lastname}}', $value['lastname'], $data['title']);
    $data['title'] = str_replace('{{userid}}', $value['userid'], $data['title']);
    $data['title'] = str_replace('{{telephone}}', $value['telephone'], $data['title']);

    $data['message'] = str_replace('{{firstname}}', $value['firstname'], $data['message']);
    $data['message'] = str_replace('{{lastname}}', $value['lastname'], $data['message']);
    $data['message'] = str_replace('{{userid}}', $value['userid'], $data['message']);
    $data['message'] = str_replace('{{telephone}}', $value['telephone'], $data['message']);

    $data['body'] = $data['message'];

    $fields = array(
        'data' => $data,
        'priority' => 'high',
        'notification' => array(
            'title' => $data['title'],
            'body' => $data['message'],
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
        ),
        'content_available' => true,
        'to' => $value['regid']
    );

    if ($data['image'] != "") {
        $fields['notification']['image'] = $data['image'];
    }

    $fields = json_encode($fields);
    file_put_contents($logFile, $fields, FILE_APPEND);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $result = curl_exec($ch);
    file_put_contents($logFile, $result, FILE_APPEND);
    curl_close($ch);
}
