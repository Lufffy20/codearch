<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\models\Achievement;

class AchievementCest
{
    public function _before(FunctionalTester $I)
    {
        // agar login required hai
        // $I->amLoggedInAs(1);
    }

    /** INDEX PAGE TEST */
    public function testIndex(FunctionalTester $I)
    {
        $I->amOnRoute('/achievement/index');
        $I->seeResponseCodeIs(200);
        $I->see('Achievements'); // index page heading
    }

    /** CREATE TEST */
    public function testCreateAchievement(FunctionalTester $I)
    {
        $I->amOnRoute('/achievement/create');

        $I->submitForm('#achievement-form', [
            'Achievement[title]' => 'Best Developer',
            'Achievement[description]' => 'Won coding contest',
        ]);

        $I->seeResponseCodeIs(200);
        $I->see('Best Developer');
    }

    /** VIEW TEST */
    public function testViewAchievement(FunctionalTester $I)
    {
        $achievement = new Achievement([
            'title' => 'Test Achievement',
            'description' => 'Test Description',
        ]);
        $achievement->save();

        $I->amOnRoute('/achievement/view', ['id' => $achievement->id]);
        $I->see('Test Achievement');
        $I->see('Test Description');
    }

    /** UPDATE TEST */
    public function testUpdateAchievement(FunctionalTester $I)
    {
        $achievement = new Achievement([
            'title' => 'Old Title',
            'description' => 'Old Description',
        ]);
        $achievement->save();

        $I->amOnRoute('/achievement/update', ['id' => $achievement->id]);

        $I->submitForm('#achievement-form', [
            'Achievement[title]' => 'Updated Title',
            'Achievement[description]' => 'Updated Description',
        ]);

        $I->see('Updated Title');
    }

    /** DELETE TEST */
    public function testDeleteAchievement(FunctionalTester $I)
    {
        $achievement = new Achievement([
            'title' => 'Delete Me',
            'description' => 'To be deleted',
        ]);
        $achievement->save();

        $I->sendPost('/achievement/delete', ['id' => $achievement->id]);
        $I->seeResponseCodeIs(302);

        $I->dontSeeRecord(Achievement::class, [
            'id' => $achievement->id,
        ]);
    }
}
