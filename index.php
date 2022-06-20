<?php
    require __DIR__ . "/vendor/autoload.php";

    use Goutte\Client;
    use Symfony\Component\HttpClient\HttpClient;
   
    $client=new Client();
    //$client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
    //This produces foo=1&bar=2&bar=3&baz=4
    
    
    //var_dump($crawler);

    /// Avoir offre
    
    //$crawler = $client->request('GET', 'https://candidat.pole-emploi.fr/offres/emploi/mamoudzou/v773');
    /// SEND DATA POLE EMPLOI TO MY SERVER

/*
    $crawler = $client->request('GET', 'https://candidat.pole-emploi.fr/offres/recherche?emission=1&lieux=97611&offresPartenaires=true&range=0-19&rayon=10&tri=0');
    $crawler->filter('li.result > a.media')
    ->each(
        function ($node) {
            $url = $node->attr('href');
            $nom = trim($node->filter('h2')->text());
            $ville = trim($node->filter('p.subtext > span')->text());
            $typeContrat = trim($node->filter('p.contrat')->text());

            $client = new Client();
            $clientdescripteur = $client->request('GET' , 'https://candidat.pole-emploi.fr'.$url);
            $clientdescripteur->filter('div.row > div.description')
            ->each(
                function ($ewa) use ($nom,$url,$ville ,$typeContrat) { 
                    $description=$ewa->filter('p')->text();
                    $queryParams = [
                        "titre" =>  $nom,
                        "datecreate"=> date("Y-m-d H:i:s"),
                        "description"=>  $description,
                        "salaire"=> "Non Renségner ",
                        "lieux"=> $ville,
                        "contrat"=> $typeContrat,
                        "scr"=> 'https://candidat.pole-emploi.fr'.$url
                    ];
                    $content = json_encode($queryParams);
                    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
                    $crawlerpusher = $client->request('POST', 'http://luha.c1.biz/api/jobs', [], [], ['HTTP_CONTENT_TYPE' => 'application/json'], $content); 
                    echo " Anonce $nom mise en ligne ... <br> <hr/>";
                }
            );
        }
    );

    
*/
/*
    $crawler = $client->request('GET', 'https://fr.indeed.com/emplois?l=Mayotte&fromage=1&vjk=4c9af47a8ab933e4');
   //echo($crawler->html());
    
    $crawler->filter('td.resultContent  ')
    ->each(
        function ($node) {
            //$url = $node->attr('href');
            $nom = trim($node->filter('a')->text());
            $liens= $node->filter('a')->attr('href');
            //$salaire= trim($node->filter('div.metadata')->text());
            $ville = trim($node->filter('div.companyLocation')->text());
            //$typeContrat = trim($node->filter('p.contrat')->text());
           
            $client = new Client();
            $clientdescripteur = $client->request('GET' , 'https://fr.indeed.com'.$liens);
            $clientdescripteur->filter('div.jobsearch-jobDescriptionText')
            ->each(
                function ($ewa) use ($nom,$liens,$ville) { 
                    $description=$ewa->text();
                    //$typeContrat = trim($$ewa->filter('div.companyLocation')->text());
                    //print_r([$nom,$ville,'https://fr.indeed.com'.$liens,$description]); 
                   // echo " <br> <hr/> ";
                    
                    $queryParams = [
                        "titre" =>  $nom,
                        "datecreate"=> date("Y-m-d H:i:s"),
                        "description"=>  $description,
                        "salaire"=> "Non Renségner ",
                        "lieux"=> $ville,
                        "contrat"=> 'Non défis',
                        "scr"=> 'https://fr.indeed.com'.$liens,
                    ];
                    
                    $content = json_encode($queryParams);
                    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
                    $crawlerpusher = $client->request('POST', 'http://luha.c1.biz/api', [], [], ['HTTP_CONTENT_TYPE' => 'application/json'], $content); 
                    echo " Anonce $nom à $ville mise en ligne ... <br> <hr/>";
                    
                }
            );
        }
    );

*/
    /*
    $crawler = $client->request('GET', 'https://www.apec.fr/candidat/recherche-emploi.html/emploi?motsCles=mayotte');
    //echo($crawler->html());
    
    $crawler->filter('div.card-offer')
    ->each(
        function ($node) {
            //$url = $node->attr('href');
            echo $node->html();
            $nom = trim($node->filter('h2.card-title')->text());
            //$liens= $node->filter('a')->attr('href');
            //$salaire= trim($node->filter('div.metadata')->text());
            //$ville = trim($node->filter('span.loc  ')->text());
            //$typeContrat = trim($node->filter('p.contrat')->text());
           
           // $client = new Client();
            //$clientdescripteur = $client->request('GET' , 'https://fr.indeed.com'.$liens);
            //$clientdescripteur->filter('div.jobsearch-jobDescriptionText');
            echo " Anonce $nom   ... <br> <hr/>"; 
            //echo $crawler->html()
            /*
            ->each(
                function ($ewa) use ($nom,$liens,$ville) { 
                    $description=$ewa->text();
                    //$typeContrat = trim($$ewa->filter('div.companyLocation')->text());
                    //print_r([$nom,$ville,'https://fr.indeed.com'.$liens,$description]); 
                   // echo " <br> <hr/> ";
                    
                    $queryParams = [
                        "titre" =>  $nom,
                        "datecreate"=> date("Y-m-d H:i:s"),
                        "description"=>  $description,
                        "salaire"=> "Non Renségner ",
                        "lieux"=> $ville,
                        "contrat"=> 'Non défis',
                        "scr"=> 'https://fr.indeed.com'.$liens,
                    ];
                    
                    $content = json_encode($queryParams);
                    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
                    //$crawlerpusher = $client->request('POST', 'https://127.0.0.1:8000/api/jobs', [], [], ['HTTP_CONTENT_TYPE' => 'application/json'], $content); 
                    echo " Anonce $nom à $ville mise en ligne ... <br> <hr/>";
                    
                }
            );
        }
    );
    
    */