<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use App\SmallAppliance;
use Symfony\Component\DomCrawler\Crawler;

class scrappingController extends Controller
{
    protected $products;
    protected $notfound;
    public function asyncData(Client $client) {
        for ($i = 1;$this->notfound !== 'No results found'; $i++) {

            $pageUrl = "https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc&page=$i";
            $crawler = $client->request('GET', $pageUrl);

            $this->notFound($crawler);
            $this->extractProductFrom($crawler);
        }

        return redirect()->route('index');

        // print_r(count($this->data));
    }

    public function extractProductFrom(Crawler $crawler) {

        $clases = 'search-results-product row';
        $crawler->filter("[class='$clases']")->each(function($node) {
            $data['titleProduct'] = $node->filter(".product-description .row h4 > a")->first()->text();
            $data['priceProduct'] = $node->filter(".product-description .section-title")->first()->text();
            $data['imageProduct'] = $node->filter(".product-image a picture source")->first()->attr('data-srcset');

            $smallAppliance = new SmallAppliance;
            $smallAppliance->title = $data['titleProduct'];
            $smallAppliance->price = $data['priceProduct'];
            $smallAppliance->imgUrl = $data['imageProduct'];
            $smallAppliance->save();
            // print_r($data);
            // dd($data);
            // return 'terminado';
        });
    }

    public function notFound(Crawler $crawler) {
        $nohay = $crawler->filter('.search-results > .row div')->text();
        $this->notfound = $nohay;
    }

    public function deleteAll() {

        SmallAppliance::truncate();


        return redirect()->route('index');

    }
}
