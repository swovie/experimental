<?php

use Viewi\PageEngine;
use Viewi\BaseComponent;

function RenderHomePage(
    Components\Views\Home\HomePage $_component,
    PageEngine $pageEngine,
    array $slots
    , ...$scope
) {
    $slotContents = [];
    
    $_content = '';

    $slotContents[0] = 'HomePage_Slot';
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent('Layout', [], $_component, $slotContents, [
'title' => $_component->title,
], ...$scope);
    $slotContents = [];
    $_content = "";
    return $_content;
   
}
