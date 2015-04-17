<?php
$I = new FunctionalTester($scenario);
$I->wantTo('create a retreat');
$I->signInAsRole('administrator', 'myrole@example.com');

$I->click('Sangha\'s', 'a');
$I->click('Mijn sangha', 'a');
$I->click('Evenementen', 'a');
$I->see('Er zijn nog geen evemenenten.', '.table');
$I->click('Nieuw evenement', '.btn');
$I->fillField('Omschrijving:', 'Testevenement');
$I->fillField('Begin:', '30-03-2030 21:25');
$I->fillField('Einde:', '29-03-2030 21:25');
$I->click('Maak evenement', '.btn');
$I->see('retreat end moet een datum na 30-03-2030 21:25 zijn.', '.alert');
$I->fillField('Einde:', '30-03-2030 22:25');
$I->click('Maak evenement', '.btn');
$I->see('Het nieuwe evenement is aangemaakt.', '.alert');
$I->click('Evenementen', 'a');
$I->see('Testevenement', 'a');
$I->seeRecord('tasks', array('description' => 'attending'));
