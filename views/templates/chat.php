<div class="messaging-page">
    <div class="chat">
        <section>
            <?php
            if(is_null($chat))
                echo"<p>Aucune conversation à afficher</p>";
            else{
                $conversations = $chat->getChat();
                foreach ($conversations as $conv) {
                    echo "<p class='message'><a href='index.php?action=conversation&conversationId=" . $conv->getConversationId() . "'>";
                    echo "Le ". Utils::convertDateToFrenchFormat($conv->getConversation()[0]->getDatetime()) . " ";
                    if($conv->getConversation()[0]->getSender()->getUserId() !== $_SESSION["user"])
                    {
                        echo $conv->getConversation()[0]->getSender()->getNickname() . " : ";
                    }
                    else
                    {
                        echo "Vous: ";
                    }
                    echo $conv->getConversation()[0]->getText();
                    echo "</a></p>";
                }
            } ?>
        </section>
    </div>
    <div class="conversation">
        <section>
                <?php
                if(!is_null($conversation))
                {
                    echo"<form method='post' action='index.php?action=send-message'>";
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
                            if($message->getSeenByRecipient() == false && $message->getSender()->getUserId() !== $_SESSION['user']){
                                $message->setSeenByRecipient(true);
                                echo "<p class='message unread-message'>";
                                echo "<input type='hidden' name='seenByRecipient' value=" . $message->getId() . ">";
                            }
                            else
                                echo "<p class='message'>";
                            if($message->getSender()->getUserId() !== $_SESSION['user']){
                                echo "Le " . Utils::convertDateToFrenchFormat($message->getDatetime()) . " " .
                                    $message->getSender()->getNickname() ." a écrit: ";
                            }
                            else{
                                echo "Le " . Utils::convertDateToFrenchFormat($message->getDatetime()) . " vous avez écrit: ";
                            }
                            echo $message->getText();
                            echo "</p>";

                        }
                        echo "<input type='hidden' name='conversationId' value=" . $conversation->getConversationId() . ">";
                        echo "<input type='text' placeholder='Tapez un message' name='message'>";

                    }
                    echo "<input type='hidden' value= ". $_SESSION['user']." name='senderId'>";
                    echo "<input type='submit' value='envoyer'>";
                    echo "</form>";
                }
                ?>
        </section>
    </div>
</div>

