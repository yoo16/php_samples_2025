<?php
require_once '../app.php';

AuthUser::clear();

header('Location: ../signin/');
