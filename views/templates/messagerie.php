<?php
$messages = $conversation->getConversation();
foreach ($messages as $message) {
    echo "<p class='message'>";
    echo "Le " . Utils::convertDateToFrenchFormat($message->getDatetime()) . " " .
        $message->getSender()->getNickname() ." a écrit: ".
        $message->getText();
    echo "</p>";
}

?>