<?php

use Viewi\PageEngine;
use Viewi\BaseComponent;

function RenderLayout(
    Components\Views\Layouts\Layout $_component,
    PageEngine $pageEngine,
    array $slots
    , ...$scope
) {
    $slotContents = [];
    
    $_content = '';

    $_content .= '<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        ';
    $_content .= htmlentities($_component->title ?? '');
    $_content .= ' | Viewi
    </title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    ';
    $slotContents[0] = false;
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent('CssBundle', [], $_component, $slotContents, [
'link' => 'https://cdn.muicss.com/mui-0.10.3/css/mui.min.css',
], ...$scope);
    $slotContents = [];
    $_content = "";
    $_content .= '
    <style>
        /**
        * Sidebar CSS
        */

        #sidebar {
            background-color: #E57373;
            padding: 15px;
        }

        #content {
            padding: 26px;
        }

        @media (min-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                width: 180px;
                height: 100%;
                padding-top: 30px;
            }

            #content {
                margin-left: 240px;
                padding: 0 26px 0 0;
            }
        }
    </style>
</head>

<body>
    <div id="sidebar">
        ';
    $slotContents[0] = false;
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent('MenuBar', [], $_component, $slotContents, [], ...$scope);
    $slotContents = [];
    $_content = "";
    $_content .= '
    </div>
    <div id="content">
        ';
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent($slots[0], [], $_component, $slotContents, [], ...$scope); 
    $_content = "";
    $_content .= '
    </div>
    ';
    $slotContents[0] = false;
    $pageEngine->putInQueue($_content);
    $pageEngine->renderComponent('ViewiScripts', [], $_component, $slotContents, [], ...$scope);
    $slotContents = [];
    $_content = "";
    $_content .= '
</body>

</html>';
    return $_content;
   
}
