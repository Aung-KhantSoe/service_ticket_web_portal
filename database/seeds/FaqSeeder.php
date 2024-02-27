<?php

use Illuminate\Database\Seeder;
use App\Faq;
use App\Product;
use App\Price;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new Product();
        $product->name = 'Moodle LMS';
        $product->save();

        $price = new Price();
        $price->product_id = $product->id;
        $price->service_ticket_price = 50000;
        $price->change_request_price = 50000;
        $price->save();

        $faq = new Faq();
        $faq->question = 'I forgot my psw';
        $faq->product_id = $product->id;
        $faq->save();
        $faq = new Faq();
        $faq->question = 'Site is Slow';
        $faq->product_id = $product->id;
        $faq->save();

        $product = new Product();
        $product->name = 'Custom App';
        $product->save();

        $price = new Price();
        $price->product_id = $product->id;
        $price->service_ticket_price = 50000;
        $price->change_request_price = 50000;
        $price->save();

        $faq = new Faq();
        $faq->question = 'App is crashing ';
        $faq->product_id = $product->id;
        $faq->save();
        $faq = new Faq();
        $faq->question = 'Cant login';
        $faq->product_id = $product->id;
        $faq->save();

    }
}
