<?php

namespace CrixuAMG\Ical;

use ArrayAccess;
use Countable;
use CrixuAMG\Ical\Contracts\IcalDocumentInterface;
use CrixuAMG\Ical\Traits\HasCalendarEvents;
use Iterator;

/**
 *
 */
abstract class BaseDocument implements Iterator, Countable, ArrayAccess, IcalDocumentInterface
{
    use HasCalendarEvents;

    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $identifier;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $name;

    public function setVersion(string $version): BaseDocument
    {
        $this->version = $version;
        return $this;
    }

    public function setMethod(string $method): BaseDocument
    {
        $this->method = $method;
        return $this;
    }

    public function setIdentifier(string $company, string $project, string $language = 'EN'): BaseDocument
    {
        $this->identifier = "-//$company//$project//$language";
        return $this;
    }

    public function setName(string $name): BaseDocument
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description): BaseDocument
    {
        $this->description = $description;
        return $this;
    }
}
