<?php

namespace Asbo\Bundle\MigrationBundle\Command;

use Symfony\Component\Finder\Finder;

class Validators
{
    public static function validateFormat($format)
    {
        $format = strtolower($format);

        if (!in_array($format, array('php', 'xml', 'yml'))) {
            throw new \RuntimeException(sprintf('Format "%s" is not supported.', $format));
        }

        return $format;
    }

    /**
     * Verify if a file exist in a directory
     *
     * @param  string           $dir
     * @param  string           $filename
     * @return string|Exception
     */
    public static function validateFilepath($filepath)
    {
        $filename = basename($filepath);
        $dir      = dirname($filepath);
        $finder   = Finder::create()->files()->in($dir)->name($filename)->depth(0);

        if (count($finder) < 1) {
            throw new \InvalidArgumentException(sprintf("The file '%s' doesn't exist in %s !", $filename, $dir));
        }

        return $filepath;
    }
}
