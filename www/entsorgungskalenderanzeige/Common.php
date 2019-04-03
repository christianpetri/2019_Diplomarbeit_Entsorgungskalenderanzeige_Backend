<?php
date_default_timezone_set('Europe/London');

/**
 * Class Common
 */
Class Common
{

    /**
     * @param $title
     * @return string
     */
    public function printHeader($title): string
    {
        return "<!doctype html><html lang='en'><head><meta charset='utf-8'/><title>$title</title><link rel='stylesheet' type='text/css' href='/main.css'/><meta name='viewport' content='width=device-width, initial-scale=1.0'/></head><body>";
    }

    /**
     * @return string
     */
    public function printFooter(): string
    {
        return "</body></html>";
    }
}