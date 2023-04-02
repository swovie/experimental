<?php

use Viewi\PageEngine;
use Viewi\BaseComponent;

function RenderNotFoundPage_Slot(
    Components\Views\NotFound\NotFoundPage $_component,
    PageEngine $pageEngine,
    array $slots
    , ...$scope
) {
    $slotContents = [];
    
    $_content = '';

    $_content .= '
    <h1>Page not found</h1>
';
    return $_content;
   
}
