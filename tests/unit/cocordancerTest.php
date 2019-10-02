<?php
use PHPUnit\Framework\TestCase;
use Codeception\Test\Unit;
use App\Corpusobjects\Corpus;
use App\Corpusactions\Concordancehit;
use App\Corpusactions\Concordancer;

/**
 *
 * @covers Concordancer
 *
 **/
class ConcordancerTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function setUp()
    {
        $dbname = "pest_inter";
        $this->corpus = new Corpus();
        $this->corpus
            ->SetCorpusName($dbname)
            ->SetConnectionToCorpus()
            ->SetConnectionToMain()
            ->SetStopWords();
        //$this->corpus
        //    ->SetConfigPath("config.ini")
        //    ->SetCorpusName($dbname)
        //    ->SetLang("en")
        //    ->SetConnectionToCorpus()
        //    ->SetConnectionToMain(open_connection("dbmain", "config.ini"))
        //    ->SetStopWords();
    }

    /**
     *
     * Test creating an instance of the class
     *
     */
    public function testCreateObject()
    {
        $conc = new Concordancer($this->corpus);
        $this->assertInstanceOf(Concordancer::class, $conc);
    }

    //    /**
    //     *
    //     * Test getting hit ids for one word
    //     *
    //     */
    //    public function testGetHitsForToken()
    //    {
    //        $exp = "Convention";
    //        $this->corpus->SetFilter();
    //        $this->corpus->filter->Tokens();
    //        $conc = new Concordancer($this->corpus);
    //        $conc->GetHitIds($exp);
    //        $this->assertGreaterThan(0, sizeof($conc->hit_ids));
    //    }
    //
    //    /**
    //     *
    //     * Test fething the first 100 concordances
    //     *
    //     */
    //    public function testGetSegIds()
    //    {
    //        $exp = "Convention";
    //        $this->corpus->SetFilter();
    //        $this->corpus->filter->Tokens();
    //        $conc = new Concordancer($this->corpus);
    //        $conc->GetHitIds($exp);
    //        $conc->GetConcForHits();
    //    }
}
