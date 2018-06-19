<?php

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');


function createPhotoDatabase(){
    ORM::get_db()->exec('DROP TABLE IF EXISTS photos;');
    ORM::get_db()->exec(
        'CREATE TABLE photos (' .
            'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
            'name TEXT, ' .
            'path TEXT)'

    );
}

function createDayDatabase(){
    ORM::get_db()->exec('DROP TABLE IF EXISTS days;');
    ORM::get_db()->exec(
        'CREATE TABLE days (' .
            'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
            'name TEXT, ' .
            'count INTEGER)'

    );
}

function createUsersDatabase(){
    ORM::get_db()->exec('DROP TABLE IF EXISTS users;');
    ORM::get_db()->exec(
        'CREATE TABLE users (' .
            'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
            'username TEXT, ' .
            'password TEXT, ' .
            'isAdmin BIT) '
    );
}

function createTextDatabase(){
    ORM::get_db()->exec('DROP TABLE IF EXISTS text;');
    ORM::get_db()->exec(
        'CREATE TABLE text (' .
            'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
            'text TEXT) '
    );
}

function createChatDatabase(){
    ORM::get_db()->exec('DROP TABLE IF EXISTS chat;');
    ORM::get_db()->exec(
        'CREATE TABLE chat (' .
            'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
            'username TEXT, ' .
            'message TEXT) '
    );
}

function addPhoto($name, $path) {
    $newPhoto = ORM::for_table('photos')->create();
    $newPhoto->name = $name;
    $newPhoto->path = $path;
    $newPhoto->save();
    return $newPhoto;
}

function addDay($name, $count) {
    $newDay = ORM::for_table('days')->create();
    $newDay->name = $name;
    $newDay->count = $count;
    $newDay->save();
    return $newDay;
}

function addUser($username, $password, $isAdmin) {
    $newUser = ORM::for_table('users')->create();
    $newUser->username = $username;
    $newUser->password = $password;
    $newUser->isAdmin = $isAdmin;
    $newUser->save();
    return $newUser;
}

function addText($text) {
    $newText = ORM::for_table('text')->create();
    $newText->text = $text;
    $newText->save();
    return $newText;
}

function addChat($username, $message) {
    $newChatMessage = ORM::for_table('chat')->create();
    $newChatMessage->username = $username;
    $newChatMessage->message = $message;
    $newChatMessage->save();
    return $newChatMessage;
}

    session_start();


?>
