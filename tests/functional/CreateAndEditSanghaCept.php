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
$I->click('Maak sangha', '.btn');

$I->seeCurrentUrlEquals('/sanghas');
$I->see('Testsangha', 'a');
$I->click('Testsangha', 'a');
$I->see('Testsangha', 'h1');
$I->see('administrator', '.col-md-1');

$I->click('Wijzig gegevens', '.btn');

$I->see('Wijzig sanghagegevens', 'h1');
$I->see('Testsangha');
$I->fillField('Sanghanaam:', 'Gewijzigde sangha');
$I->click('Wijzig sangha', '.btn');
$I->see('De gegevens zijn gewijzigd', '.alert');
$I->see('Gewijzigde sangha', 'h1');
