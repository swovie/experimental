<?php

use Swovie\Components\Views\Home\HomePage;
use Swovie\Components\Views\NotFound\NotFoundPage;
use Viewi\Routing\Route as ViewiRoute;

ViewiRoute::get('/', HomePage::class);
ViewiRoute::get('*', NotFoundPage::class);
