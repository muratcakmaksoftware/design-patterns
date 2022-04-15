<?php

enum Coin
{
    case BTC;
    case MATIC;
}

enum CoinType: int
{
    case POW = 1;
    case POS = 2;
    case METAVERSE = 3;
}

/**
 * Fabrikada üretilecek olan nesnenin ortak özellikleri interface de toplanır.
 */
interface CoinInterface
{
    public function getName(): string;

    public function getPrice(): float;

    public function getType(): int;
}

/**
 * Fabrikada üretilecek olan sınıflar oluşturulur.
 */
class BTC implements CoinInterface
{
    private const NAME = 'BTC';
    private int $type = 0;
    private float $price = 0;

    public function __construct(CoinType $type, float $price)
    {
        $this->price = $price;
    }

    public function getName(): string
    {
        return BTC::NAME;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class MATIC implements CoinInterface
{
    private const NAME = 'MATIC';
    private int $type = 0;
    private float $price = 0;

    public function __construct(CoinType $type, float $price)
    {
        $this->type = $type->value;
        $this->price = $price;
    }

    public function getName(): string
    {
        return MATIC::NAME;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

/**
 * Özelliğe ait tüm sınıfları tek bir yerden üretmiş oluruz.
 */
class CoinFactory
{
    public static function create(Coin $coin): CoinInterface
    {
        return match ($coin) {
            Coin::BTC => new BTC(CoinType::POW, 1000),
            Coin::MATIC => new MATIC(CoinType::POS, 100),
            default => throw new \Exception($coin->name . ' üretimi desteklenmemektedir.')
        };
    }
}

$matic = CoinFactory::create(Coin::MATIC);
$btc = CoinFactory::create(Coin::BTC);
print $matic->getName() . '<br/>';
print $btc->getName();
/**
 * Output:
   MATIC
   BTC
 */