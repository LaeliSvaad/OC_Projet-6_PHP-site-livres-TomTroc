<?php

$messages = $conversation->getConversation();

if(is_null($messages))
{
    echo "Envoyez un premier message";
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
}

?>