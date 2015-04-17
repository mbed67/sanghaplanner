<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('leave a Sangha');

$user = $I->signInAsRole('lid', 'myrole@example.com');

$I->click('Sangha\'s', 'a');
$I->click('Mijn sangha', 'a');
$I->click('Sangha verlaten', '.btn');

$I->amOnPage('/sanghas');
