<?php

$messages = $conversation->getConversation();


foreach ($messages as $message) {
    echo "<p class='message'>";
    echo $message->getSender()->getNickname() ." a écrit: ". $message->getText();
    echo "</p>";
}

?>