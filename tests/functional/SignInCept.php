<?php 
$I = new FunctionalTester($scenario);
$I->am('a Sanghaplanner member');
$I->wantTo('Log in to my Sanghaplanner account');

$I->signIn();

$I->seeCurrentUrlEquals('');

$I->see('Welkom terug!');
$I->assertTrue(Auth::check());