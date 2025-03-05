<?php

$pw = 'l1234567';
$hash = '$2y$10$qmTPPaVe8Fasl.KTuXCmROOPUM78Ie66Xj1B5TdI5j9cpQdHQHHuG';

echo password_hash($pw, PASSWORD_DEFAULT);