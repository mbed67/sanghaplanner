<?php
$I = new FunctionalTester($scenario);

$I->am('a Sangha admin');
$I->wantTo('reject a membership');

$I->have('Sanghaplanner\Roles\Role', ['rolename' => 'lid']);
$user = $I->signInAsRole('administrator');

$I->haveANotification($user, [
    'user_id' => $user->id,
    'object_id' => $user->sanghas()->where('sanghaname', '=', 'Mijn sangha')->first()->id
]);

$I->see('1');
$I->click('Meldingen');
$I->see('Mijn sangha');

$I->click('Sangha\'s');
$I->click('Mijn sangha');
$I->see('Goedkeuren');
$I->see('Afwijzen');
$I->click('Afwijzen');
$I->see('Deze persoon is geweigerd als lid van sangha Mijn sangha');
$I->dontSee('<td class="col-md-1"> lid');
$I->see('Er zijn geen verzoeken');
