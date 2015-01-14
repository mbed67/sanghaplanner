<?php
$I = new FunctionalTester($scenario);

$I->am('Sanghaplanner member');
$I->wantTo('view my profile');

$I->signIn();

$I->click('Profiel');

$I->see('foo de bar');

