<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use App\Product;
use DB;
use Symfony\Component\DomCrawler\Crawler;

class scrappingController extends Controller
{
    protected $products;
    protected $notfound;

    public function asyncDiswashers(Client $client) {
        $this->asyncDataDishwashers($client);
        return redirect()->back();
    }
    public function asyncSmallAppliance(Client $client) {
        $this->asyncDataSmallAppliance($client);
        return redirect()->back();
    }

    public function asyncDataSmallAppliance($client) {
        for ($i = 1;$this->notfound !== 'No results found'; $i++) {

            $pageUrl = "https://www.appliancesdelivered.ie/search/small-appliances?sort=price_desc&page=$i";
            $crawler = $client->request('GET', $pageUrl);

            $this->notFound($crawler);
            $this->extractProductSmallApplianceFrom($crawler);

        }
    }

    public function asyncDataDishwashers($client) {
        for ($i = 1;$this->notfound !== 'No results found'; $i++) {

            $pageUrl = "https://www.appliancesdelivered.ie/dishwashers?sort=price_asc&page=$i";
            $crawler = $client->request('GET', $pageUrl);

            $this->notFound($crawler);
            $this->extractProductDishwashersFrom($crawler);

        }
    }

    public function extractProductSmallApplianceFrom(Crawler $crawler) {

        $clases = 'search-results-product row';
        $crawler->filter("[class='$clases']")->each(function($node) {
            $data['titleProduct'] = $node->filter(".product-description .row h4 > a")->first()->text();
            $data['priceProduct'] = $node->filter(".product-description .section-title")->first()->text();
            $data['imageProduct'] = $node->filter(".product-image a picture source")->first()->attr('data-srcset');

            $product = new Product;

            // Product::create([
            //     'title' => $data['titleProduct'],
            //     'price' => $data['priceProduct'],
            //     'imgUrl' => $data['imageProduct'],
            //     'category_id' => 1
            // ]);
            $product->title = $data['titleProduct'];
            $product->price = $data['priceProduct'];
            $product->imgUrl = $data['imageProduct'];
            $product->category_id = 1;
            $product->save();

        });
    }
    public function extractProductDishwashersFrom(Crawler $crawler) {

        $clases = 'search-results-product row';
        $crawler->filter("[class='$clases']")->each(function($node) {
            $data['titleProduct'] = $node->filter(".product-description .row h4 > a")->first()->text();
            $data['priceProduct'] = $node->filter(".product-description .section-title")->first()->text();
            $data['imageProduct'] = $node->filter(".product-image a picture source")->first()->attr('data-srcset');


            // Product::create([
            //     'title' => $data['titleProduct'],
            //     'price' => $data['priceProduct'],
            //     'imgUrl' => $data['imageProduct'],
            //     'category_id' => 2
            // ]);
            $product = new Product;
            $product->title = $data['titleProduct'];
            $product->price = $data['priceProduct'];
            $product->imgUrl = $data['imageProduct'];
            $product->category_id = 2;
            $product->save();

            // print_r($data);

        });
    }

    public function notFound(Crawler $crawler) {
        $nohay = $crawler->filter('.search-results > .row div')->text();
        $this->notfound = $nohay;
    }

    public function deleteAll() {

        DB::table('products')->delete();


        return redirect()->back();

    }
}
