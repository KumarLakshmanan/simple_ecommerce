<?php
function convertEpochToTimeAgoNotification($epoch)
{
    if (is_string($epoch)) {
        $epoch = intval($epoch);
    }
    if (strlen(strval($epoch)) != 10) {
        $epoch = $epoch / 1000;
    }
    $date = new DateTime("@$epoch");
    $now = new DateTime();
    $difference = $now->getTimestamp() - $date->getTimestamp();
    $timeAgo = '';

    if ($difference <= 0 || ($difference > 0 && $difference < 60)) {
        $timeAgo = 'Just now';
    } elseif ($difference >= 60 && $difference < 3600) {
        $minutes = floor($difference / 60);
        $timeAgo = $minutes . ' minutes ago';
    } elseif ($difference >= 3600 && $difference < 86400) {
        $hours = floor($difference / 3600);
        $timeAgo = $hours . ' hours ago';
    } elseif ($difference >= 86400 && $difference < 172800) {
        $timeAgo = 'Yesterday';
    } elseif ($difference >= 172800 && $difference < 604800) {
        $days = floor($difference / 86400);
        $timeAgo = $days . ' days ago';
    } elseif ($difference >= 604800 && $difference < 1209600) {
        $timeAgo = '1 week ago';
    } elseif ($difference >= 1209600 && $difference < 1814400) {
        $timeAgo = '2 weeks ago';
    } elseif ($difference >= 1814400 && $difference < 2419200) {
        $timeAgo = '3 weeks ago';
    } else {
        $timeAgo = $date->format('d M Y');
    }

    return $timeAgo;
}
