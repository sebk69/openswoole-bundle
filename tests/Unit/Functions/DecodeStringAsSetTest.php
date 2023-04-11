<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Functions;

use PHPUnit\Framework\TestCase;

class DecodeStringAsSetTest extends TestCase
{
    public function decodedPairsProvider(): array
    {
        return [
            'normal set' => [
                'value1,value2,value3',
                ['value1', 'value2', 'value3'],
            ],
            'json set' => [
                "['value1','value2','value3']",
                ['value1', 'value2', 'value3'],
            ],
            'empty apostrophe set' => [
                "['''',''''',''''']",
                ['', '', ''],
            ],
            'apostrophe set' => [
                "['value1''','''value2'','''value3'']",
                ['value1', 'value2', 'value3'],
            ],
            'set from empty string' => [
                '',
                [],
            ],
            'empty set from null' => [
                null,
                [],
            ],
        ];
    }

    /**
     * @dataProvider decodedPairsProvider
     *
     * @param string $string
     */
    public function testDecodeStringAsSet(?string $string, array $set): void
    {
        self::assertSame($set, \OpenSwooleBundle\decode_string_as_set($string));
    }
}
