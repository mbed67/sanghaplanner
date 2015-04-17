<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('join a Sangha');

$I->haveASanghaWithRole('administrator');
$I->signIn();

$I->click('Sangha\'s', 'a');
$I->click('Lid worden', '.btn');
$I->see('Je verzoek is verstuurd', '.alert');
