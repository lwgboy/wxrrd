<?php


namespace Quanpan302\Wxrrd;


use Quanpan302\Foundation\Foundation;

/**
 * Class Wxrrd
 * @package Quanpan302\Wxrrd
 *
 * @property \Quanpan302\Wxrrd\Ticket\Token $token
 * @property \Quanpan302\Wxrrd\Ticket\Ticket $ticket
 * @property \Quanpan302\Wxrrd\Customer\Customer $customer
 * @property \Quanpan302\Wxrrd\Product\Product $product
 */
class Wxrrd extends Foundation
{

    protected $providers = [
        Token\ServiceProvider::class,
        Ticket\ServiceProvider::class,
        Customer\ServiceProvider::class,
        Product\ServiceProvider::class,
    ];

}
