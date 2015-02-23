<?php
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for a Sanghaplanner account');

$I->amOnPage('/');
$I->click('Aanmelden');
$I->seeCurrentUrlEquals('/auth/register');

$I->fillField('Email:', 'john@example.com');
$I->fillField('Wachtwoord:', 'demodemo');
$I->fillField('Nogmaals wachtwoord:', 'demodemo');
$I->fillField('Voornaam:', 'John');
$I->fillField('Achternaam:', 'Doe');
$I->fillField('Adres:', 'Spoorweg 1');
$I->fillField('Postcode:', '1234 AA');
$I->fillField('Woonplaats:', 'Amsterdam');
$I->click('Registreer');

$I->seeRecord('users', array('firstname' => 'John'));


$I->seeCurrentUrlEquals('/home');
$I->see('Je bent ingelogd!');

$I->seeRecord('users', [
    'email' => 'john@example.com'
]);

$I->assertTrue(Auth::check());
