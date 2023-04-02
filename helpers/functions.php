<?php

function base_path(string $path = ''): string
{
    return BASE_DIR . $path;
}

function public_path(string $path = ''): string
{
    return base_path("public/$path");
}