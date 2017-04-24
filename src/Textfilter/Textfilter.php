<?php

namespace Vinter\Textfilter;

/**
 * Class for formatting text to the browser
 */
class Textfilter
{
    /**
     * Let a text go through filters for formatting
     * @param $text string Text to be filtered
     * @param $filters string Comma seperated list of filters to be applied
     * @return string Filtered string
     */
    public function doFilter($text, $filters)
    {
        $callbacks = [
            "bbcode"    => "bbcode2html",
            "clickable" => "makeClickable",
            "markdown"  => "markdown",
            "nl2br"     => "nl2br",
            "strip"     => "strip",
            "esc"       => "esc"
        ];
        $filter = preg_replace('/\s/', '', explode(',', $filters));
        foreach ($filter as $key) {
            if (!isset($callbacks[$key])) {
                continue;
            }
            $text = call_user_func_array([$this, $callbacks[$key]], [$text]);
        }
        return $text;
    }

    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string text The text to be converted.
     * @returns string the formatted text.
     */
    public function bbcode2html($text)
    {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is',
            );
        $replace = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
            );
        return preg_replace($search, $replace, $text);
    }

    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text the text that should be formatted.
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }

    /**
     * Helper, Markdown formatting converting to HTML.
     *
     * @param string text The text to be converted.
     *
     * @return string the formatted text.
     */
    public function markdown($text)
    {
        $markdownObj = new \Michelf\Markdown();
        return $markdownObj->defaultTransform($text);
    }

    /**
     * For convenience access to nl2br
     *
     * @param string $text text to be converted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }

    /**
     * Sanitize value for output in view.
     * @param string $value to sanitize
     * @return string beeing sanitized
     */
    public function esc($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    public function strip($text)
    {
        return strip_tags($text);
    }
}
