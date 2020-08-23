php artisan scandinaver:command
php artisan scandinaver:query


START TRANSACTION;

INSERT INTO `cards`(`word_id`, `translate_id`, `type`, language_id)
SELECT card.word_id, card.translate_id, word.sentence, word.language_id FROM card
JOIN word ON (card.word_id = word.id) WHERE 1;

INSERT INTO asset_cards(asset_id, card_id)
SELECT card.asset_id, cards.id FROM card
JOIN cards ON(card.word_id = cards.word_id AND card.translate_id=cards.translate_id);

COMMIT;