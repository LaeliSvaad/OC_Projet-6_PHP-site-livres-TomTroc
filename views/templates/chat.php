<div class="messaging-page">
    <div class="chat">
        <section>
            <?php
                $conversations = $chat->getChat();
                foreach ($conversations as $conv) {
                    echo "<p class='message'><a href='index.php?action=conversation&conversationId=" . $conv->getConversationId() . "'>";
                    echo "Le ". Utils::convertDateToFrenchFormat($conv->getConversation()[0]->getDatetime()) . " " .
                        $conv->getConversation()[0]->getSender()->getNickname() ." a écrit: ".
                        $conv->getConversation()[0]->getText();
                    echo "</a></p>";
                } ?>
        </section>
    </div>
    <div class="conversation">
        <section>
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
                        if($message->getSeenByRecipient() == false)
                            echo "<p class='message unread-message'>";
                        else
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
        </section>
    </div>
</div>

