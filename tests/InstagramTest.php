<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Instagram;

use PHPUnit\Framework\TestCase;
use Vinkla\Instagram\Instagram;

/**
 * This is the instagram test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramTest extends TestCase
{
    public function testGet()
    {
        $items = (new Instagram())->get('jerryseinfeld');

        $this->assertInternalType('array', $items);
        $this->assertCount(20, $items);
    }

    /**
     * @expectedException \Vinkla\Instagram\InstagramException
     */
    public function testNotFound()
    {
        (new Instagram())->get('imspeechlessihavenospeech');
    }

    public function testGetEmbed()
    {
        $instagram = new Instagram();

        $posts = $instagram->get('jerryseinfeld');
        $uri = $posts[0]->link;

        $embed = $instagram->getEmbed($uri);

        $this->assertInternalType('object', $embed);
        $this->assertObjectHasAttribute('html', $embed);
    }

    /**
     * @expectedException \Vinkla\Instagram\InstagramException
     */
    public function testGetEmbedNotFound()
    {
        (new Instagram())->getEmbed('https://www.instagram.com/p/invalidpostid/');
    }

    /**
     * @expectedException \Vinkla\Instagram\InstagramException
     */
    public function testGetEmbedInvalid()
    {
        (new Instagram())->getEmbed('xx');
    }
}
