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
                            <span><?= $conv->getInterlocutor()->getNickname() ?></span>
                            <?= $conv->getConversation()[0]->getText() . "  ". Utils::convertDateToFrenchFormat($conv->getConversation()[0]->getDatetime())?>
                        </div>
                    </div>
               </a>
            <?php endforeach; endif; ?>
        </div>
        <div class="col-xs-12 col-sm-9">
            <img class="profile-picture" src="<?= $interlocutor->getPicture() ?>" alt="<?= $interlocutor->getNickname() ?> profile picture">
            <span><?= $interlocutor->getNickname() ?></span>
        </div>
    </div>
</div>
