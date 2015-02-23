<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('join and unjoin a Sangha');

$I->haveASanghaWithAnAdministrator();
$I->signIn();

$I->click('Sangha\'s');
$I->click('Mijn sangha');
$I->click('Vraag lidmaatschap aan voor sangha Mijn sangha');
$I->see('Je verzoek is verstuurd');
