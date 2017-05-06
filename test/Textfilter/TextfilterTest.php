<?php

namespace Vinter\Textfilter;

/**
 * Test cases for class Session
 */
class TextfilterTest extends \PHPUnit_Framework_TestCase
{
    public function testDoFilter()
    {
        $textfilter = new Textfilter();
        $text = "**https://dbwebb.se/**";
        $filters = "markdown,hello,link";
        $filtered = $textfilter->doFilter($text, $filters);
        $expected = "<p><strong><a href='https://dbwebb.se/'>"
            . "https://dbwebb.se/</a></strong></p>\n";
        $this->assertEquals($filtered, $expected);
    }

    public function testBbcode2html()
    {
        $textfilter = new Textfilter();
        $raw = '[url=https://sv.wikipedia.org/wiki/BBCode]BBCode [/url]';
        $filtered = $textfilter->bbcode2html($raw);
        $expected = '<a href="https://sv.wikipedia.org/wiki/BBCode">BBCode </a>';
        $this->assertEquals($filtered, $expected);
    }

    public function testMakeClickable()
    {
        $textfilter = new Textfilter();
        $raw = "https://dbwebb.se/";
        $filtered = $textfilter->makeClickAble($raw);
        $expected = "<a href='https://dbwebb.se/'>https://dbwebb.se/</a>";
        $this->assertEquals($filtered, $expected);
    }

    public function testMarkdown()
    {
        $textfilter = new Textfilter();
        $raw = "**bold** and *italic*";
        $filtered = $textfilter->markdown($raw);
        $expected = "<p><strong>bold</strong> and <em>italic</em></p>\n";
        $this->assertEquals($filtered, $expected);
    }

    public function testNl2br()
    {
        $textfilter = new Textfilter();
        $raw = "hello\n there";
        $filtered = $textfilter->nl2br($raw);
        $expected = "hello<br />\n there";
        $this->assertEquals($filtered, $expected);
    }

    public function testEsc()
    {
        $textfilter = new Textfilter();
        $raw = "A 'quote' is <b>bold</b>";
        $filtered = $textfilter->esc($raw);
        $expected = "A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;";
        $this->assertEquals($filtered, $expected);
    }

    public function testStrip()
    {
        $textfilter = new Textfilter();
        $raw = "<p>Test paragraph.</p>";
        $filtered = $textfilter->strip($raw);
        $expected = "Test paragraph.";
        $this->assertEquals($filtered, $expected);
    }

    public function testSlugify()
    {
        $textfilter = new Textfilter();
        $raw = "This is a title";
        $filtered = $textfilter->slugify($raw);
        $expected = "this-is-a-title";
        $this->assertEquals($filtered, $expected);
    }
}
