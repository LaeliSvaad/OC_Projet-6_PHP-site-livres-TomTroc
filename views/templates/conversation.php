
<form method='post' action='index.php?action=send-message'>

<?php

$messages = $conversation->getConversation();

if(is_null($messages))
{
    echo "<input type='text' placeholder='Envoyez un premier message' name='message'>";
    echo "<input type='hidden' name='user1Id' value=" . $conversation->getUser1Id() . ">";
    echo "<input type='hidden' name='user2Id' value=" . $conversation->getUser2Id() . ">";
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
    echo "<input type='hidden' name='conversationId' value=" . $conversation->getConversationId() . ">";
    echo "<input type='text' placeholder='Tapez un message' name='message'>";

}
echo"<input type='hidden' value= ". $_SESSION['user']." name='senderId'>";
?>
<input type="submit" value="envoyer">
</form>
