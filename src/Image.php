<?php

namespace Waredesk;

use Waredesk\Exceptions\UnknownImageTypeException;

class Image
{
    private const IMAGE_TYPE_MAP = [
        1 => 'gif',
        2 => 'jpg',
        3 => 'png',
        5 => 'psd',
        6 => 'bmp',
        7 => 'tiff',
        8 => 'tiff'
    ];

    const IMAGE_TYPE_PNG = 'png';
    const IMAGE_TYPE_JPG = 'jpg';
    const IMAGE_TYPE_GIF = 'gif';
    const IMAGE_TYPE_PSD = 'psd';
    const IMAGE_TYPE_TIFF = 'tiff';
    const IMAGE_TYPE_BMP = 'bmp';

    private $content;
    private $type;

    public function __construct(string $path, string $type = null)
    {
        $content = $path;
        if (substr_count($path, PHP_EOL) === 0 && file_exists($path)) {
            $type = exif_imagetype($path);
            if (!isset(self::IMAGE_TYPE_MAP[$type])) {
                throw new UnknownImageTypeException();
            }
            $type = self::IMAGE_TYPE_MAP[$type];
            $content = file_get_contents($path);
        }
        if (!in_array($type, [
            self::IMAGE_TYPE_BMP, self::IMAGE_TYPE_GIF, self::IMAGE_TYPE_JPG, self::IMAGE_TYPE_PNG,
            self::IMAGE_TYPE_PSD, self::IMAGE_TYPE_TIFF
        ])
        ) {
            throw new UnknownImageTypeException();
        }
        $this->content = $content;
        $this->type = $type;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
