<?php

Require __DIR__ . "/vendor/autoload.php";

use Goutte\Client;

use Symfony\Component\HttpClient\HttpClient;

class add_daily_jobs {
    private $bdd;
    private $client;

    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=pole_emploi;charset=utf8', 'root', '');
        $this->client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
    }

    public function add_daily_jobs_from_indeed() {
        $crawler = $this->client->request('GET', 'https://fr.indeed.com/emplois?l=Mayotte&fromage=1&vjk=4c9af47a8ab933e4');
        $crawler->filter('td.resultContent  ')
        ->each(
            function ($node) {
                $url = $node->filter('a')->attr('href');
                $nom = trim($node->filter('a')->text());
                $ville = trim($node->filter('span.company')->text());
                $typeContrat = trim($node->filter('span.jobtitle')->text());
                $description = trim($node->filter('span.summary')->text());
                $salaire = trim($node->filter('span.salaryText')->text());
                $lieux = trim($node->filter('span.location')->text());
                $datecreate = date("Y-m-d H:i:s");
                $scr = 'https://fr.indeed.com'.$url;
                $queryParams = [
                    "titre" =>  $nom,
                    "datecreate"=> $datecreate,
                    "description"=>  $description,
                    "salaire"=> $salaire,
                    "lieux"=> $lieux,
                    "contrat"=> $typeContrat,
                    "scr"=> $scr
                ];
                $content = json_encode($queryParams);
                $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
                $crawlerpusher = $client->request('POST', 'http://luha.c1.biz/api/jobs', [], [], ['HTTP_CONTENT_TYPE' => 'application/json'], $content);
                $response = $crawlerpusher->getContent();
                $response = json_decode($response, true);
                if ($response['status'] == 'success') {
                    echo 'success';
                } else {
                    echo 'error';
                }
            }
        );
    }

    //add daily jobs from pole emploi
    public function add_daily_jobs_from_pole_emploi() {
        $crawler = $this->client->request('GET', 'https://www.pole-emploi.fr/candidat/recherche-de-poste?lieu=Mayotte&page=1');
        $crawler->filter('div.liste-annonces > div.liste-annonces-item')
        ->each(
            function ($node) {
                $url = $node->filter('a')->attr('href');
                $nom = trim($node->filter('a')->text());
                $ville = trim($node->filter('span.ville')->text());
                $typeContrat = trim($node->filter('span.type-contrat')->text());
                $description = trim($node->filter('span.description')->text());
                $salaire = trim($node->filter('span.salaire')->text());
                $lieux = trim($node->filter('span.lieu')->text());
                $datecreate = date("Y-m-d H:i:s");
                $scr = 'https://www.pole-emploi.fr'.$url;
                $queryParams = [
                    "titre" =>  $nom,
                    "datecreate"=> $datecreate,
                    "description"=>  $description,
                    "salaire"=> $salaire,
                    "lieux"=> $lieux,
                    "contrat"=> $typeContrat,
                    "scr"=> $scr
                ];
                $content = json_encode($queryParams);
                $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
                $crawlerpusher = $client->request('POST', 'http://luha.c1.biz/api/jobs', [], [], ['HTTP_CONTENT_TYPE' => 'application/json'], $content);
                $response = $crawlerpusher->getContent();
                $response = json_decode($response, true);
                if ($response['status'] == 'success') {
                    echo 'success';
                } else {
                    echo 'error';
                }
            }
        );
    }

    // check if job is already in database
    public function check_if_job_is_already_in_database($url) {
        $sql = "SELECT * FROM jobs WHERE scr = '$url'";
        $query = $this->bdd->query($sql);
        $result = $query->fetchAll();
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
