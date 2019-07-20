<?php declare(strict_types=1);
namespace App\Type;

use App\ValueObject\Progress;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class ProgressType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'float';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Progress
    {
        return Progress::create($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): float
    {
        if (!$value instanceof Progress) {
            throw new \RuntimeException();
        }

        return $value->get();
    }

    public function getName(): string
    {
        return 'progress';
    }
}
