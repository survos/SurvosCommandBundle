<?php

namespace Survos\WebCliBundle\Service;


class WebCliService
{
    public function __construct(private readonly string $title) {

    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
