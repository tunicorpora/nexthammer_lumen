<?php

namespace App\Corpusactions;

use App\Corpusobjects\Corpus;
use App\Corpusactions\Concordancehit;

/**
 *
 * A concordancer: fetches a words or an expressions concordance.
 *
 * @property  Corpus $corpus a corpus object: the (sub)corpus
 *            we are using to get the concordances from
 * @property  Boolean $uselemmas whether or not to interpret the search terms as lemmas
 * @property  Integer $hitlimit maximum number of hits per page
 * @property  Array $hit_ids ids of the matches in the original table
 *
 */
class Concordancer
{
    protected $corpus;
    protected $uselemmas = false;
    protected $hitlimit = 100;
    public $hit_ids = [];
    public $hits = [];

    public function __construct(Corpus $corp)
    {
        $this->corpus = $corp;
    }

    /**
     *
     * Sets using lemmas on
     *
     */
    public function SetUseLemmas()
    {
        $this->uselemmas = true;
    }

    /**
     *
     * TODO cql parser etc
     *
     * Gets the ids
     *
     * @param String $exp an expression to search for: will be split by spaces if more than one word
     *
     */
    public function GetHitIds($exp)
    {
        #0. Split the expression

        $query = "SELECT id 
            FROM {$this->corpus->filter->target_table_prefix}_{$this->corpus->lang}
            WHERE 
            {$this->corpus->filter->target_col} = $1
            ";

        try {
            $result = pg_query_params($this->corpus->corpuscon, $query, [$exp]);
        } catch (Exception $err) {
            echo "\n$err\n";
            var_dump($query);
        }

        $this->hit_ids = pg_fetch_all_columns($result);
    }

    /**
     *
     *
     *
     */
    public function GetConcForHits($range = [0, 10])
    {
        for ($i = $range[0]; $i < $range[1]; $i++) {
            $hit = new Concordancehit($this->corpus->corpuscon);
            $hit->SetOrigId($this->hit_ids[$i]);
            $hit->SetContext($this->corpus->lang);
            $this->hits[] = $hit;
            if ($i >= sizeof($this->hit_ids) - 1) {
                break;
            }
        }
    }

    /**
     * Outputs the concordances found
     *
     * TODO pagination
     *
     * @return void
     */
    public function output()
    {
        return array_map(function ($hit) {
            return $hit->context;
        }, $this->hits);
    }
}
