<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('create and edit a sangha');

$I->signIn();
$I->createAnAdministratorRole();

$I->amOnPage('/createsangha');
$I->fillField('Sanghanaam:', 'Testsangha');
$I->fillField('Adres:', 'Testadres');
$I->fillField('Postcode:', '1111 VV');
$I->fillField('Plaats:', 'Testplaats');
$I->click('Maak sangha');

$I->seeCurrentUrlEquals('/sanghas');
$I->see('Testsangha');
$I->click('Testsangha');
$I->see('Testsangha');
$I->see('administrator');

$I->click('Wijzig gegevens');

$I->see('Wijzig sanghagegevens');
$I->see('Testsangha');
$I->fillField('Sanghanaam:', 'Gewijzigde sangha');
$I->click('Wijzig sangha');
$I->see('De gegevens zijn gewijzigd');
$I->see('Gewijzigde sangha');
