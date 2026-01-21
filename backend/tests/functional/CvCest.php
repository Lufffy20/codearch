<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\models\User;
use common\fixtures\UserFixture;
use Yii;
use PHPUnit\Framework\Assert;

class CvCest
{
    public function _fixtures()
    {
        return [
            'users' => UserFixture::class,
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $user = User::findByUsername('erau');
        $I->amLoggedInAs($user);
    }

    /**  Test CV page loads */
    public function viewCvPage(FunctionalTester $I)
    {
        $I->amOnRoute('/cv/cv');
        $I->seeResponseCodeIs(200);
        $I->see('CV');
    }

    /**  Test CV cache clear */
    public function clearCvCache(FunctionalTester $I)
    {
        Yii::$app->cache->set('cv_data', ['test' => 'data']);

        $I->stopFollowingRedirects();
        $I->amOnRoute('/cv/clear-cv-cache');

        $I->seeResponseCodeIs(302);

        $cvData = Yii::$app->cache->get('cv_data');
        Assert::assertFalse($cvData);
    }


    /** Test CV PDF download */
    public function downloadCvPdf(FunctionalTester $I)
    {
        $I->amOnRoute('/cv/download');
        $I->seeResponseCodeIs(200);

        $I->see('%PDF');

        Assert::assertStringContainsString(
            'application/pdf',
            Yii::$app->response->headers->get('Content-Type')
        );
    }
}
