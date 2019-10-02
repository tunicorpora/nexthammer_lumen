<?php 

class CorpusMetaCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToListLanguages(ApiTester $I)
    {
        $I->wantTo("List languages in a corpus");
        $I->sendGet("http://localhost:8000/api/v1/corpora/pest_inter/languages");
        $I->seeResponseIsJson();
    }
}
