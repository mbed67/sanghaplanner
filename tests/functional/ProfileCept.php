<?php
$I = new FunctionalTester($scenario);

$I->am('Sanghaplanner member');
$I->wantTo('edit my profile');

$I->signInAsRole('lid', 'myrole@example.com');

$I->click('Profiel', 'a');

$I->see('myrole@example.com', 'td');
$I->see('Mijn sangha', 'a');
$I->click('Wijzig gegevens', '.btn');
$I->fillField('firstname', 'New First Name');
$I->click('Wijzig', '.btn');
$I->see('De gegevens zijn gewijzigd', '.alert');
$I->see('New First Name', 'h1');

$I->haveAnAccount(['firstname' => 'Other user']);

$I->click('Ledenlijst', 'a');
$I->click('Other user', '.user-block-username');
$I->see('Email', 'td');
$I->see('Sangha', 'th');
$I->dontSee('Wijzig gegevens');
