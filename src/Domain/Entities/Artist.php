<?php

namespace Konscia\CifraClub\Domain\Entities;

use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;

class Artist
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var HtmlDomParser
     */
    private $htmlPage;

    public function __construct(Slug $slug, HtmlDomParser $htmlPage)
    {
        $this->name = $htmlPage->getElementById("span_bread")->innerHtml;
        $this->slug = $slug;
        $this->htmlPage = $htmlPage;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getHtmlPage(): HtmlDomParser
    {
        return $this->htmlPage;
    }
}