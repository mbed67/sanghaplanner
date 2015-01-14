<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('create a sangha');

$I->signIn();
$I->haveAnAdministrator();

$I->amOnPage('/createsangha');
$I->fillField('Sanghanaam:', 'Testsangha');
$I->click('Maak sangha');

$I->seeCurrentUrlEquals('/sanghas');
$I->see('Testsangha');
