<?php
$I = new FunctionalTester($scenario);

$I->am('a Sanghaplanner member');
$I->wantTo('join a Sangha');

$I->haveASanghaWithRole('administrator');
$I->signIn();

$I->click('Sangha\'s');
$I->click('Mijn sangha');
$I->click('Vraag lidmaatschap aan voor sangha Mijn sangha');
$I->see('Je verzoek is verstuurd');
