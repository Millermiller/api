<?php

namespace Tests\Unit;

use Aws\Polly\PollyClient;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $config = [
            'version' => 'latest',
            'region' => 'us-west-2',
            'credentials' => [
                'key' => 'AKIAJWOGPPCN5LZXKKFQ',
                'secret' => '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',
            ],
        ];

        $client = new PollyClient($config);
        $polly_args = [
            'Engine' => 'standard',
            'LanguageCode' => 'is-IS',
            'OutputFormat' => 'json',
            'Text' => 'Hvað er að frétta?',
            'TextType' => 'text',
            'VoiceId' => 'Dora',
        ];
        $result = $client->synthesizeSpeech($polly_args);
        var_dump($result);
    }
}
