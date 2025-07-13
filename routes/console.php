<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('generate:sitemap', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/division'))
        ->add(Url::create('/portfolio'))
        ->add(Url::create('/article'))
        ->add(Url::create('/career'))
        ->add(Url::create('/contact'))
        ->writeToFile(public_path('sitemap.xml'));
});