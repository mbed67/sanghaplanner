<?php
$I = new FunctionalTester($scenario);

$I->am('Sanghaplanner member');
$I->wantTo('edit my profile');

$I->signInAsRole('lid');

$I->click('Profiel');

$I->see('myrole@example.com');
$I->see('Mijn sangha');
$I->click('Wijzig gegevens');
$I->fillField('firstname', 'New First Name');
$I->click('Wijzig');
$I->see('De gegevens zijn gewijzigd');
$I->see('New First Name');

$I->haveAnAccount(['firstname' => 'Other user']);

$I->click('Ledenlijst');
$I->click('Other user');
$I->see('Email');
$I->see('Sangha');
$I->dontSee('Wijzig gegevens');
