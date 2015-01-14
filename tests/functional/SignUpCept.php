<?php 
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for a Sanghaplanner account');

$I->amOnPage('/');
$I->click('Aanmelden');
$I->seeCurrentUrlEquals('/register');

$I->fillField('Email:', 'john@example.com');
$I->fillField('Wachtwoord:', 'demo');
$I->fillField('Nogmaals wachtwoord:', 'demo');
$I->fillField('Voornaam:', 'John');
$I->fillField('Achternaam:', 'Doe');
$I->fillField('Adres:', 'Spoorweg 1');
$I->fillField('Postcode:', '1234 AA');
$I->fillField('Woonplaats:', 'Amsterdam');
$I->click('Registreer');

$I->seeCurrentUrlEquals('');
$I->see('Welkom bij de Sanghaplanner');

$I->seeRecord('users', [
    'email' => 'john@example.com'
]);

$I->assertTrue(Auth::check());