<?php


namespace Quanpan302\Wxrrd;


use Hanson\Foundation\Foundation;

/**
 * Class Pospal
 * @package Quanpan302\Wxrrd
 *
 * @property \Quanpan302\Wxrrd\Ticket\Ticket $ticket
 * @property \Quanpan302\Wxrrd\Customer\Customer $customer
 * @property \Quanpan302\Wxrrd\Product\Product $product
 */
class Pospal extends Foundation
{

    protected $providers = [
        Ticket\ServiceProvider::class,
        Customer\ServiceProvider::class,
        Product\ServiceProvider::class,
    ];

}
