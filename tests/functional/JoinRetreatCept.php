<?php
$I = new FunctionalTester($scenario);
$I->wantTo('join a retreat');

$sanghaId = $I->haveASanghaWithARetreat();


$user = $I->signIn();
$role = $I->createAMemberRole();
$user->sanghas()->attach($sanghaId, array('role_id' => $role->id));

$I->click('Sangha\'s', 'a');
$I->click('Mijn sangha', 'a');
$I->click('Evenementen', 'a');
$I->see('Evenementen voor deze sangha', '.panel-heading');
$I->see('Testevenement', 'a');
$I->click('Aanmelden', '.btn');
$I->click('Mijn sangha', 'a');
$I->click('Evenementen', 'a');
$I->dontSee('Aanmelden', '.btn');
$I->seeRecord('tasks', array('description' => 'attending'));
