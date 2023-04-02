<?php

use Viewi\PageEngine;

function ReadComponentsInfo(PageEngine $pageEngine)
{
    $pageEngine->setStartups(array (
));
$pageEngine->setComponentsInfo(array (
  'MenuBar' => 
  array (
    'Name' => 'MenuBar',
    'Namespace' => 'Swovie\\Components\\Views\\Common',
    'ComponentName' => 'MenuBar',
    'Tag' => 'MenuBar',
    'FullPath' => '/Views/Common/MenuBar.php',
    'TemplatePath' => '/Views/Common/MenuBar.html',
    'BuildPath' => '/Views/Common/MenuBar.php',
    'RenderFunction' => 'RenderMenuBar',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => false,
    'Relative' => true,
    'Inputs' => 
    array (
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Instance' => NULL,
  ),
  'HomePage' => 
  array (
    'Name' => 'HomePage',
    'Namespace' => 'Swovie\\Components\\Views\\Home',
    'ComponentName' => 'HomePage',
    'Tag' => 'HomePage',
    'FullPath' => '/Views/Home/HomePage.php',
    'TemplatePath' => '/Views/Home/HomePage.html',
    'BuildPath' => '/Views/Home/HomePage.php',
    'RenderFunction' => 'RenderHomePage',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => false,
    'Relative' => true,
    'Inputs' => 
    array (
      'title' => true,
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Instance' => NULL,
  ),
  'Layout' => 
  array (
    'Name' => 'Layout',
    'Namespace' => 'Swovie\\Components\\Views\\Layouts',
    'ComponentName' => 'Layout',
    'Tag' => 'Layout',
    'FullPath' => '/Views/Layouts/Layout.php',
    'TemplatePath' => '/Views/Layouts/Layout.html',
    'BuildPath' => '/Views/Layouts/Layout.php',
    'RenderFunction' => 'RenderLayout',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => false,
    'Relative' => true,
    'Inputs' => 
    array (
      'title' => true,
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Instance' => NULL,
  ),
  'NotFoundPage' => 
  array (
    'Name' => 'NotFoundPage',
    'Namespace' => 'Swovie\\Components\\Views\\NotFound',
    'ComponentName' => 'NotFoundPage',
    'Tag' => 'NotFoundPage',
    'FullPath' => '/Views/NotFound/NotFoundPage.php',
    'TemplatePath' => '/Views/NotFound/NotFoundPage.html',
    'BuildPath' => '/Views/NotFound/NotFoundPage.php',
    'RenderFunction' => 'RenderNotFoundPage',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => false,
    'Relative' => true,
    'Inputs' => 
    array (
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Instance' => NULL,
  ),
  'CssBundle' => 
  array (
    'Name' => 'CssBundle',
    'Namespace' => 'Viewi\\Components\\Assets',
    'ComponentName' => 'CssBundle',
    'Tag' => 'CssBundle',
    'FullPath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Components/Assets/CssBundle.php',
    'TemplatePath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Components/Assets/CssBundle.html',
    'BuildPath' => '/Viewi/Components/Assets/CssBundle_v1.php',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => true,
    'Relative' => false,
    'Inputs' => 
    array (
      'links' => true,
      'link' => true,
      'minify' => true,
      'combine' => true,
      'inline' => true,
      'shakeTree' => true,
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Versions' => 
    array (
      'https://cdn.muicss.com/mui-0.10.3/css/mui.min.css0000' => 
      array (
        'key' => '_v1',
        'RenderFunction' => 'RenderCssBundle_v1',
        'BuildPath' => '/Viewi/Components/Assets/CssBundle_v1.php',
      ),
    ),
    'Instance' => NULL,
  ),
  'HttpClient' => 
  array (
    'Name' => 'HttpClient',
    'Namespace' => 'Viewi\\Common',
    'FullPath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Common/HttpClient.php',
    'IsComponent' => false,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'Relative' => false,
    'Dependencies' => 
    array (
      'asyncStateManager' => 
      array (
        'name' => 'AsyncStateManager',
      ),
    ),
    'Instance' => NULL,
  ),
  'AsyncStateManager' => 
  array (
    'Name' => 'AsyncStateManager',
    'Namespace' => 'Viewi\\Components\\Services',
    'FullPath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Components/Services/AsyncStateManager.php',
    'IsComponent' => false,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'Relative' => false,
    'Instance' => 
    array (
    ),
  ),
  'ViewiScripts' => 
  array (
    'Name' => 'ViewiScripts',
    'Namespace' => 'Viewi\\Components\\Assets',
    'ComponentName' => 'ViewiScripts',
    'Tag' => 'ViewiScripts',
    'FullPath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Components/Assets/ViewiScripts.php',
    'TemplatePath' => '/home/ahmard/projects/swovie/experimental/vendor/viewi/viewi/src/Viewi/Components/Assets/ViewiScripts.html',
    'BuildPath' => '/Viewi/Components/Assets/ViewiScripts.php',
    'RenderFunction' => 'RenderViewiScripts',
    'IsComponent' => true,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'HasVersions' => false,
    'Relative' => false,
    'Inputs' => 
    array (
      'responses' => true,
      '__id' => true,
      '_props' => true,
      '_refs' => true,
      '_element' => true,
      '_slots' => true,
    ),
    'Dependencies' => 
    array (
      'httpClient' => 
      array (
        'name' => 'HttpClient',
      ),
      'asyncStateManager' => 
      array (
        'name' => 'AsyncStateManager',
      ),
    ),
    'Instance' => NULL,
  ),
  'HomePage_Slot' => 
  array (
    'Name' => 'HomePage_Slot',
    'Namespace' => 'Swovie\\Components\\Views\\Home',
    'ComponentName' => 'HomePage',
    'Tag' => 'HomePage_Slot',
    'FullPath' => '/Views/Home/HomePage.php',
    'TemplatePath' => '/Views/Home/HomePage_Slot.html',
    'BuildPath' => '/_slots/Views/Home/HomePage_Slot.php',
    'RenderFunction' => 'RenderHomePage_Slot',
    'IsComponent' => false,
    'IsSlot' => true,
    'Relative' => true,
    'Instance' => NULL,
  ),
  'NotFoundPage_Slot' => 
  array (
    'Name' => 'NotFoundPage_Slot',
    'Namespace' => 'Swovie\\Components\\Views\\NotFound',
    'ComponentName' => 'NotFoundPage',
    'Tag' => 'NotFoundPage_Slot',
    'FullPath' => '/Views/NotFound/NotFoundPage.php',
    'TemplatePath' => '/Views/NotFound/NotFoundPage_Slot.html',
    'BuildPath' => '/_slots/Views/NotFound/NotFoundPage_Slot.php',
    'RenderFunction' => 'RenderNotFoundPage_Slot',
    'IsComponent' => false,
    'IsSlot' => true,
    'Relative' => true,
    'Instance' => NULL,
  ),
  'IHttpContext' => 
  array (
    'Name' => 'IHttpContext',
    'Namespace' => 'Viewi\\WebComponents',
    'FullPath' => '',
    'IsComponent' => false,
    'HasInit' => false,
    'HasMounted' => false,
    'HasBeforeMount' => false,
    'Instance' => 
    array (
    ),
  ),
));   
}
