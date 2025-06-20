

<?php
echo $user->getNickname();
echo"<br>";
echo $user->getEmail();
echo"<br>";
echo "<img src='" . $user->getPicture() . "' alt='photo de profil de " . $user->getNickname() . "'/>";


