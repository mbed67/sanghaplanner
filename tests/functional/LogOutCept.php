<?php
$I = new FunctionalTester($scenario);

$I->am('Sanghaplanner member');
$I->wantTo('log out');

$I->signIn();

$I->click('Uitloggen');

$I->dontSee('foo@example.com');
$I->amOnPage('/');
