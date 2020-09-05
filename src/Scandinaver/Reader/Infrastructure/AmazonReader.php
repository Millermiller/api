<?php


namespace Scandinaver\Reader\Infrastructure;

use Aws\Credentials\Credentials;
use Aws\Polly\PollyClient;
use GuzzleHttp\Psr7\Stream;
use Scandinaver\Common\Domain\Contract\HashInterface;
use Scandinaver\Common\Domain\Contract\RedisInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\User\Domain\Model\User;
use Storage;

/**
 * Class AmazonReader
 *
 * @package Scandinaver\Reader\Infrastructure
 */
class AmazonReader implements ReaderInterface
{
    private PollyClient $pollyClient;

    private HashInterface $hasher;

    private RedisInterface $redisClient;

    private string $format;

    private string $speed;

    public function __construct(HashInterface $hasher, RedisInterface $redisClient)
    {
        $this->format = config('aws.polly.output_format');
        $this->speed = config('aws.polly.speed');

        $credits = new Credentials('AKIAIOSMR72CKHF2DS3Q', 'TKNp+Eth/J5/NfgAEUcRrMI/8+JS66PgwpAzC6R3');

        $config = [
            'version' => 'latest',
            'region' => 'us-west-2',
            'credentials' => $credits,
        ];

        $this->pollyClient = new PollyClient($config);
        $this->hasher = $hasher;
        $this->redisClient = $redisClient;
    }

    public function read(User $user, Language $language, string $text)
    {
        $ssmltext = $this->generateSsmlString($text);

        $polly_args = [
            'Engine' => 'standard',
            'LanguageCode' => $this->resolveLanguage($language),
            'OutputFormat' => $this->format,
            'Text' => $ssmltext,
            'TextType' => 'ssml',
            'VoiceId' => $this->resolveVoice($language),
        ];

        $filename = $this->hashFilename($text);

        $cashed = $this->redisClient->hget($filename, $language->getName());

        if ($cashed !== null) {
            if (Storage::disk('voices')->exists($filename)) {
                return Storage::disk('voices')->path($filename);
            }
        }

        $data = $this->pollyClient->synthesizeSpeech($polly_args)->toArray();

        /** @var Stream $stream */
        $stream = $data['AudioStream'];

        $file = $stream->getContents();

        Storage::disk('voices')->put($filename, $file);

        $this->redisClient->hset($filename, $language->getName(), $filename);

        return Storage::disk('voices')->path($filename);
    }

    private function generateSsmlString(string $input): string
    {
        return "<speak><prosody rate='$this->speed'>$input</prosody></speak>";
    }

    private function resolveLanguage(Language $language): string
    {
        switch ($language->getName()) {
            case 'is':
                return 'is-IS';
                break;

            default:
                return 'is-IS';
        }
    }

    private function resolveVoice(Language $language): string
    {
        switch ($language->getName()) {
            case 'is':
                return 'Dora';
                break;

            default:
                return 'Dora';
        }
    }

    private function hashFilename(string $input): string
    {
        return $this->hasher->hash($input).'.'.$this->format;
    }
}