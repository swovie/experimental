<?php

namespace Swovie\Components\Views\Home;

use Faker\Factory;
use Faker\Generator;
use Viewi\BaseComponent;

class HomePage extends BaseComponent
{
    public string $title;
    public string $message;
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();

        $this->title = "Hello";
        $this->message = $this->faker->name();
    }
}
