<?php


namespace Tests\Unit\Repositories\Asset;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\User\Domain\Entity\{User};
use Tests\TestCase;

/**
 * Class AssetRepositoryTest
 *
 * @package Tests\Repositories\Asset
 */
class AssetRepositoryTest extends TestCase
{

    protected const LANGUAGE    = 'is';
    protected const WORD_ASSET_COUNT = 2;
    protected const SENTENCE_ASSET_COUNT = 3;

    private EntityManager $entityManager;

    private AssetRepositoryInterface $wordAssetsRepository;
    private AssetRepositoryInterface $sentenceAssetsRepository;
    private AssetRepositoryInterface $assetsRepository;

    private Language $language;

    private User $user;

    private \Illuminate\Support\Collection $wordAssets;

    private \Illuminate\Support\Collection $sentenceAssets;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->language = entity(Language::class)->create(['letter' => self::LANGUAGE]);

        $this->user = entity(User::class)->create();

        $this->wordAssets = entity(WordAsset::class, self::WORD_ASSET_COUNT)->create([
            'user'     => $this->user,
            'language' => $this->language,
        ]);

        $this->sentenceAssets = entity(SentenceAsset::class, self::SENTENCE_ASSET_COUNT)->create([
            'user'     => $this->user,
            'language' => $this->language,
        ]);

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->wordAssetsRepository = $this->app->make(WordAssetRepositoryInterface::class);
        $this->sentenceAssetsRepository = $this->app->make(SentenceAssetRepositoryInterface::class);
        $this->assetsRepository = $this->app->make(AssetRepositoryInterface::class);
    }

    public function testGetByLanguage(): void
    {
        $wordAssets     = $this->wordAssetsRepository->getByLanguage($this->language);
        $sentenceAssets = $this->sentenceAssetsRepository->getByLanguage($this->language);

        $this->assertCount(self::WORD_ASSET_COUNT, $wordAssets);
        $this->assertCount(self::SENTENCE_ASSET_COUNT, $sentenceAssets);

        /** @var Asset $wordAsset */
        $wordAsset = reset($wordAssets);
        /** @var Asset $sentenceAsset */
        $sentenceAsset = reset($sentenceAssets);

        $this->assertInstanceOf(WordAsset::class, $wordAsset);
        $this->assertInstanceOf(SentenceAsset::class, $sentenceAsset);

        $this->assertInstanceOf(Language::class, $wordAsset->getLanguage());
        $this->assertEquals(self::LANGUAGE, $wordAsset->getLanguage()->getLetter());
        $this->assertInstanceOf(Language::class, $sentenceAsset->getLanguage());
        $this->assertEquals(self::LANGUAGE, $sentenceAsset->getLanguage()->getLetter());

        $this->assertInstanceOf(User::class, $wordAsset->getOwner());
        $this->assertEquals($this->user->getId(), $wordAsset->getOwner()->getId());
        $this->assertInstanceOf(User::class, $sentenceAsset->getOwner());
        $this->assertEquals($this->user->getId(), $sentenceAsset->getOwner()->getId());
    }

    public function testGetCountByLanguage()
    {
        $count = $this->assetsRepository->getCountByLanguage($this->language);

        $this->assertEquals(self::WORD_ASSET_COUNT + self::SENTENCE_ASSET_COUNT, $count);
    }

    public function testGetPublicAssets(): void
    {
        $assets = $this->assetsRepository->getPublicAssets($this->language);

        $this->assertIsArray($assets);
        $this->assertCount(self::WORD_ASSET_COUNT + self::SENTENCE_ASSET_COUNT, $assets);

        $wordAssets = array_filter($assets, function($asset) {
            return $asset->getType() === Asset::TYPE_WORDS;
        });

        $sentenceAssets = array_filter($assets, function($asset) {
            return $asset->getType() === Asset::TYPE_SENTENCES;
        });

        $this->assertCount(self::WORD_ASSET_COUNT, $wordAssets);
        $this->assertCount(self::SENTENCE_ASSET_COUNT, $sentenceAssets);

        $wordAsset = reset($wordAssets);
        $sentenceAsset = reset($sentenceAssets);

        $this->assertInstanceOf(WordAsset::class, $wordAsset);
        $this->assertInstanceOf(SentenceAsset::class, $sentenceAsset);

        $this->assertInstanceOf(Language::class, $wordAsset->getLanguage());
        $this->assertEquals(self::LANGUAGE, $wordAsset->getLanguage()->getLetter());
        $this->assertInstanceOf(Language::class, $sentenceAsset->getLanguage());
        $this->assertEquals(self::LANGUAGE, $sentenceAsset->getLanguage()->getLetter());

        $this->assertInstanceOf(User::class, $wordAsset->getOwner());
        $this->assertEquals($this->user->getId(), $wordAsset->getOwner()->getId());
        $this->assertInstanceOf(User::class, $sentenceAsset->getOwner());
        $this->assertEquals($this->user->getId(), $sentenceAsset->getOwner()->getId());
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function testGetFirstAsset(): void
    {
        $firstWordAsset = $this->wordAssetsRepository->getFirstLevel($this->language);
        $firstSentenceAsset = $this->sentenceAssetsRepository->getFirstLevel($this->language);

        $this->assertEquals(Asset::TYPE_WORDS, $firstWordAsset->getType());
        $this->assertEquals(1, $firstWordAsset->getLevel());

        $this->assertEquals(Asset::TYPE_SENTENCES, $firstSentenceAsset->getType());
        $this->assertEquals(1, $firstSentenceAsset->getLevel());
    }

    /**
     * @throws NonUniqueResultException|NoResultException
     */
    public function testGetLastAsset(): void
    {
        $lastWordAsset = $this->wordAssetsRepository->getLastLevel($this->language);
        $lastSentenceAsset = $this->sentenceAssetsRepository->getLastLevel($this->language);

        $this->assertEquals(Asset::TYPE_WORDS, $lastWordAsset->getType());
        $this->assertEquals(self::WORD_ASSET_COUNT, $lastWordAsset->getLevel());

        $this->assertEquals(Asset::TYPE_SENTENCES, $lastSentenceAsset->getType());
        $this->assertEquals(self::SENTENCE_ASSET_COUNT, $lastSentenceAsset->getLevel());
    }

    /**
     * @throws NonUniqueResultException
     */
    public function testGetNextAsset(): void
    {
        $firstWordAsset = $this->wordAssets[0];
        $firstSentenceAsset = $this->sentenceAssets[0];

        $nextWordAsset = $this->wordAssetsRepository->getNextLevel($firstWordAsset);
        $nextSentenceAsset = $this->sentenceAssetsRepository->getNextLevel($firstWordAsset);

        $this->assertEquals(Asset::TYPE_WORDS, $nextWordAsset->getType());
        $this->assertEquals($firstWordAsset->getLevel() + 1, $nextWordAsset->getLevel());

        $this->assertEquals(Asset::TYPE_SENTENCES, $nextSentenceAsset->getType());
        $this->assertEquals($firstSentenceAsset->getLevel() + 1, $nextSentenceAsset->getLevel());

        $nextWordAssetThatNotExists = $this->wordAssetsRepository->getNextLevel($nextWordAsset);
        $this->assertNull($nextWordAssetThatNotExists);
    }
}
