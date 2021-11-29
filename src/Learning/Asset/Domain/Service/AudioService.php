<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Contract\AudioParserInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Exception\AudioFileCantParsedException;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\TermNotFoundException;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class AudioService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AudioService implements BaseServiceInterface
{
    use TermTrait;
    use LanguageTrait;

    private TermRepositoryInterface $termRepository;

    private AudioParserInterface $parser;

    public function __construct(
        TermRepositoryInterface $termRepository,
        AudioParserInterface $parser
    ) {
        $this->termRepository = $termRepository;
        $this->parser          = $parser;
    }

    public function count(): int
    {
        return $this->termRepository->countAudio();
    }

    /**
     * @param  string  $language
     *
     * @return int
     * @throws LanguageNotFoundException
     */
    public function countByLanguage(string $language): int
    {
        $language = $this->getLanguage($language);

        return $this->termRepository->getCountAudioByLanguage($language);
    }

    /**
     * @param  int           $id
     * @param  UploadedFile  $file
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function upload(int $id, UploadedFile $file): Term
    {
        $term = $this->getTerm($id);

        $path = $file->store('audio');

        $term->setAudio($path);

        $this->termRepository->save($term);

        return $term;
    }

    /**
     * TODO: use laravel curl wrapper and Storage. Move to infrastructure
     *
     * @param  int  $id
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function parse(int $id): Term
    {
        $term = $this->getTerm($id);

        try {
            $link = $this->parser->parse($term->getValue());

            $curl = curl_init();
            curl_setopt(
                $curl,
                CURLOPT_URL,
                'https://forvo.com/player-mp3Handler.php?path=' . $link
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            //curl_setopt($curl, CURLOPT_COOKIEFILE, BASE_URL . '/temp/cookie.txt');
            $file = curl_exec($curl);
            curl_close($curl);

            $filename = Str::random(32);

            touch(public_path() . '/audio/' . $filename . '.mp3');
            $fp       = fopen(public_path() . '/audio/' . $filename . '.mp3', 'w');
            $filesize = fwrite($fp, $file);
            fclose($fp);

            if ($filesize > 0) {
                $term->setAudio('/audio/' . $filename . '.mp3');
                $this->termRepository->save($term);
            }
        } catch (AudioFileCantParsedException $e) {
            //
        }

        return $term;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function one(int $id): DTO
    {
        // TODO: Implement one() method.
    }

}