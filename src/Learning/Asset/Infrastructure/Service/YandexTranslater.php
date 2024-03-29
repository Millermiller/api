<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Service\TranslaterInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Term;

/**
 * Class YandexTranslater
 *
 * @package Scandinaver\Learn\Infrastructure\Service
 */
class YandexTranslater implements TranslaterInterface
{
    private Client $client;

    private string $folder;

    private string $key;

    private LoggerInterface $logger;

    private string $defaultLanguage = 'ru';

    private string $format = 'PLAIN_TEXT';

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;

        $this->folder = config('yandex.cloud_folder');
        $this->key    = config('yandex.translate_secret');
        $this->logger = $logger;
    }

    public function translate(Language $language, Term $term): ?array
    {
        try {
            return $this->getTranslate($language, $term->getValue());
        } catch (GuzzleException $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param  Language  $language
     * @param  string    $text
     *
     * @return mixed
     * @throws GuzzleException
     */
    private function getTranslate(Language $language, string $text)
    {
        $response = $this->client
            ->request(
                'POST',
                'https://translate.api.cloud.yandex.net/translate/v2/translate',
                [
                    'json'    => [
                        'sourceLanguageCode' => $this->defaultLanguage,
                        'targetLanguageCode' => $this->resolveLanguage($language),
                        'format'             => $this->format,
                        'folder_id'          => $this->folder,
                        'texts'              => [
                            $text,
                        ],
                    ],
                    'headers' => [
                        'Authorization' => "Api-Key {$this->key}",
                    ],
                ]
            );

        $content = $response->getBody()->getContents();

        return \GuzzleHttp\json_decode($content, TRUE);
    }

    private function resolveLanguage(Language $language): string
    {
        switch ($language->getTitle()) {
            case 'is':
                return 'is';
                break;

            default:
                return 'is';
        }
    }
}