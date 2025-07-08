<?php
$conversations = $chat->getChat();
foreach ($conversations as $conversation) {
    echo "<p class='message'>";
    echo $conversation->getConversation()[0]->getSender()->getNickname() ." a écrit: ". $conversation->getConversation()[0]->getText();
    echo "</p>";
}
