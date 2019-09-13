<?php
namespace App\Controllers\Modules;

class SampleVendorCMS extends \App\Controllers\BaseController
{

    public function renderArticle($article, $responseid = null)
    {

        echo '<pre>';

        echo 'Method ' . __METHOD__ . ($responseid ? ' with reader response id ' . $responseid : '');

        echo "\n";

        print_r($article);
    }
}