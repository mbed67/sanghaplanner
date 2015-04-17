<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('list all users who are registered for Sanghaplanner');

$I->haveAnAccount(['firstname' => 'Foo']);
$I->haveAnAccount(['firstname' => 'Bar']);

$I->signIn();

$I->amOnPage('/users');
$I->see('Foo', '.user-block-username');
$I->see('Bar', '.user-block-username');
