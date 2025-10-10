<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <h2 class="playfair-display-title-font">Messagerie</h2>
            <?php  if (is_null($chat)): ?>
            <div><span>Aucune conversation à afficher</span></div>
            <?php else:
                $conversations = $chat->getChat();
                foreach ($conversations as $conv) : ?>
                <a href="index.php?action=conversation&user1Id=<?= $_SESSION['user']?>&user2Id=<?= $conv->getInterlocutor()->getUserId()?>">
                    <div class="row">
                        <div class="col-xs-4">
                            <img class="profile-picture" src="<?= $conv->getInterlocutor()->getPicture() ?>" alt="<?= $conv->getInterlocutor()->getNickname() ?>">
                        </div>
                        <div class="col-xs-8">
                            <div><?= $conv->getInterlocutor()->getNickname() ."  ". Utils::convertDateToFrenchFormat($conv->getConversation()[0]->getDatetime())?></div>
                            <div><?= $conv->getConversation()[0]->getText()?></div>
                        </div>
                    </div>
               </a>
            <?php endforeach; endif; ?>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div>
                <img class="profile-picture" src="<?= $interlocutor->getPicture() ?>" alt="<?= $interlocutor->getNickname() ?> profile picture">
                <span><?= $interlocutor->getNickname() ?></span>
                <?php foreach ($conversation->getConversation() as $message) :
                        ?>
                        <div>
                            <?= $message->getSender()->getPicture() ?>
                        </div>
                        <div>
                            <?= $message->getText() ?>
                        </div>
                    <?php endforeach;  ?>
            </div>
        </div>
    </div>
</div>
