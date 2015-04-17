<?php
$I = new FunctionalTester($scenario);
$I->am('a Sanghaplanner member');
$I->wantTo('Log in to my Sanghaplanner account');

$I->signIn();

$I->seeRecord('users', array('firstname' => 'foo'));

$I->seeCurrentUrlEquals('/home');

$I->see('foo@example.com', '.dropdown');
$I->assertTrue(Auth::check());
