<?php

namespace Tests\Utils\SchemaAssertions;

use ReflectionClass;
use Symfony\Component\Finder\Finder as SymfonyFinder;

final class Finder
{
    private static bool $cached = false;

    private static array $assertions = [];

    public static function locate(): array
    {
        if (!self::$cached) {
            $finder = new SymfonyFinder();
            $finder->files()->in(__DIR__);

            foreach ($finder as $file) {
                if (!$file->isFile()) {
                    continue;
                }

                $class = __NAMESPACE__ . "\\{$file->getFilenameWithoutExtension()}";

                if (!class_exists($class)) {
                    continue;
                }

                $ref = new ReflectionClass($class);

                if ($ref->isAbstract() || !$ref->isSubclassOf(AssertSchema::class)) {
                    continue;
                }

                self::$assertions[] = $class;
            }

            self::$cached = true;
        }

        return self::$assertions;
    }
}
