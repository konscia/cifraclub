<?php

namespace Konscia\CifraClub\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    /**
     * @dataProvider dpValidSlugs
     */
    public function testValidSlug($slug)
    {
        self::assertEquals($slug, new Slug($slug));
    }

    public function dpValidSlugs()
    {
        return [
            ['lulu-santos'],
            ['blitz'],
            ['1-direction']
        ];
    }

    /**
     * @dataProvider dpInvalidSlugs
     */
    public function testInvalidSlugs($slug)
    {
        self::expectException(\InvalidArgumentException::class);
        new Slug($slug);
    }

    public function dpInvalidSlugs()
    {
        return [
            ['--'],
            ['-artista'],
            ['artista-'],
            ['Artista'],
            ['sertanejo1-&-sertanejo2']
        ];
    }
}
