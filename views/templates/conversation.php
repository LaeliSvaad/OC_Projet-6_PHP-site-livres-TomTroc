
<form method='post' action='index.php?action=send-message'>

<?php


if(is_null($conversation))
{
    echo "<input type='text' placeholder='Envoyez un premier message' name='message'>";

}
else
{
    $messages = $conversation->getConversation();
    foreach ($messages as $message)
    {
        echo "<p class='message'>";
        echo "Le " . Utils::convertDateToFrenchFormat($message->getDatetime()) . " " .
            $message->getSender()->getNickname() ." a écrit: ".
            $message->getText();
        echo "</p>";

    }
    echo "<input type='hidden' name='conversationId' value=" . $conversation->getConversationId() . ">";
    echo "<input type='text' placeholder='Tapez un message' name='message'>";

}

?>
<input type="submit" value="envoyer">
</form>
