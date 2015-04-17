<?php
$I = new FunctionalTester($scenario);

$I->am('a Sangha admin');
$I->wantTo('reject a membership');

$I->have('Sanghaplanner\Roles\Role', ['rolename' => 'lid']);
$user = $I->signInAsRole('administrator', 'myrole@example.com');

$I->haveANotification($user, [
    'user_id' => $user->id,
    'object_id' => $user->sanghas()->where('sanghaname', '=', 'Mijn sangha')->first()->id
]);

$I->click('Meldingen', '.dropdown-toggle');
$I->see('1', '.badge');
$I->see('Mijn sangha', '.notification-body');

$I->click('Sangha\'s', 'a');
$I->click('Mijn sangha', 'a');
$I->see('Goedkeuren', '.btn');
$I->see('Afwijzen', '.btn');
$I->click('Afwijzen', '.btn');
$I->see('Deze persoon is geweigerd als lid van sangha Mijn sangha', '.alert');
$I->dontSee('<td class="col-md-1"> lid');
$I->see('Er zijn geen verzoeken', '.col-md-3');
