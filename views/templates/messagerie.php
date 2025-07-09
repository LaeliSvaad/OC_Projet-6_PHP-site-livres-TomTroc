
<form method='post' action='index.php?action=send-message'>

<?php
$messages = $conversation->getConversation();
echo "<input type='hidden' name='userId' value=" . $conversation->getUser2Id() . ">";
if(is_null($messages))
{
    echo "<input type='text' placeholder='Envoyez un premier message' name='message'>";

}
else
{
    foreach ($messages as $message)
    {
        echo "<p class='message'>";
        echo "Le " . Utils::convertDateToFrenchFormat($message->getDatetime()) . " " .
            $message->getSender()->getNickname() ." a écrit: ".
            $message->getText();
        echo "</p>";

    }
    echo "<input type='text' placeholder='Tapez un message' name='message'>";

}

?>
<input type="submit" value="envoyer">
</form>
