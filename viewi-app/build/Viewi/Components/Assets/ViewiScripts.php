<?php

use Viewi\PageEngine;
use Viewi\BaseComponent;

function RenderViewiScripts(
    Viewi\Components\Assets\ViewiScripts $_component,
    PageEngine $pageEngine,
    array $slots
    , ...$scope
) {
    $slotContents = [];
    
    $_content = '';

    $_content .= '';
    $_content .= $_component->getDataScript();
    $_content .= '
<script defer src="/viewi-build/app.js"></script>';
    return $_content;
   
}
