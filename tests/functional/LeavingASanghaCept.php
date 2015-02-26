<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('leave a Sangha');

$user = $I->signInAsRole('lid');

$I->click('Sangha\'s');
$I->click('Mijn sangha');
$I->click('Verlaat sangha Mijn sangha');

$I->see('Je bent geen lid meer van Mijn sangha');
