<?php
$conversations = $chat->getChat();
foreach ($conversations as $conversation) {
    echo "<p class='message'><a href='index.php?action=conversation&conversationId=" . $conversation->getConversationId() . "'>";
    echo "Le ". Utils::convertDateToFrenchFormat($conversation->getConversation()[0]->getDatetime()) . " " .
        $conversation->getConversation()[0]->getSender()->getNickname() ." a écrit: ".
        $conversation->getConversation()[0]->getText();
    echo "</a></p>";
}
