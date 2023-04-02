<?php

use Viewi\PageEngine;
use Viewi\BaseComponent;

function RenderNotFoundPage(
    Swovie\Components\Views\NotFound\NotFoundPage $_component,
    PageEngine $pageEngine,
    array $slots
    , ...$scope
) {
    $slotContents = [];
    
    $_content = '';

    $slotContents[0] = 'NotFoundPage_Slot';
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent('Layout', [], $_component, $slotContents, [
'title' => 'Page Not Found',
], ...$scope);
    $slotContents = [];
    $_content = "";
    return $_content;
   
}
