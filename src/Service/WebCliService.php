<?php

namespace Survos\WebCliBundle\Service;


class WebCliService
{
    public function __construct(private string $title) {

    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
