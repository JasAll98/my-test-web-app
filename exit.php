<?php

setcookie('user', $row['login'], time() + 3600*24, "/ ");


header("location: /");

?>