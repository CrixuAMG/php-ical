<?php

namespace CrixuAMG\Ical\ICS;

use CrixuAMG\Ical\Contracts\ICSInterface;
use DateTimeInterface;

/**
 *
 */
class CalenderEvent implements ICSInterface
{
    /**
     * @var string
     */
    protected $type = 'VEVENT';
    /**
     * @var string
     */
    protected $organizer;
    /**
     * @var string
     */
    protected $location;
    /**
     * @var
     */
    protected $uid;
    /**
     * @var string
     */
    protected $summary;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var DateTimeInterface
     */
    protected $startDate;
    /**
     * @var DateTimeInterface
     */
    protected $endDate;
    /**
     * @var DateTimeInterface
     */
    protected $entireDay;
    /**
     * @var DateTimeInterface
     */
    protected $lastModified;
    /**
     * @var DateTimeInterface
     */
    protected $dateStamp;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var array
     */
    private $categories;

    /**
     * @param  string  $type
     * @return CalenderEvent
     */
    public function setType(string $type): CalenderEvent
    {
        if (!in_array($type, ['VEVENT', 'VTODO', 'VJOURNAL', 'VFREEBUSY'])) {
            throw new \InvalidArgumentException('Calendar event type '.$type.' is not supported by ical standards.');
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return CalenderEvent
     */
    public static function create(): CalenderEvent
    {
        return new self();
    }

    /**
     * @param  string  $value
     */
    public function organizer(string $value)
    {
        $this->organizer = $value;
    }

    /**
     * @param  DateTimeInterface  $value
     * @return $this
     */
    public function setStartDate(DateTimeInterface $value): CalenderEvent
    {
        $this->startDate = $value;
        return $this;
    }

    /**
     * @param  DateTimeInterface  $value
     * @return $this
     */
    public function setEndDate(DateTimeInterface $value): CalenderEvent
    {
        $this->endDate = $value;
        return $this;
    }

    /**
     * @param  DateTimeInterface  $value
     * @return $this
     */
    public function setEntireDay(DateTimeInterface $value): CalenderEvent
    {
        $this->entireDay = $value;
        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function setSummary(string $value): CalenderEvent
    {
        $this->summary = $value;
        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function setOrganizer(string $value): CalenderEvent
    {
        $this->organizer = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setUid($value): CalenderEvent
    {
        $this->uid = $value;
        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function setStatus(string $value): CalenderEvent
    {
        $this->status = $value;
        return $this;
    }

    /**
     * @param  DateTimeInterface  $value
     * @return $this
     */
    public function setLastModified(DateTimeInterface $value): CalenderEvent
    {
        $this->lastModified = $value;
        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function setLocation(string $value): CalenderEvent
    {
        $this->location = $value;
        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function setDescription(string $value): CalenderEvent
    {
        $this->description = $value;
        return $this;
    }

    /**
     * @param  DateTimeInterface  $value
     * @return $this
     */
    public function setDateStamp(DateTimeInterface $value): CalenderEvent
    {
        $this->dateStamp = $value;
        return $this;
    }

    public function setCategories(array $categories): CalenderEvent
    {
        $this->categories = $categories;
        return $this;
    }

    public function __toString(): string
    {
        $string = "BEGIN:$this->type".PHP_EOL;

        if ($this->entireDay) {
            $string .= "DTSTART;VALUE=DATE:".date('Ymd', strtotime($this->entireDay)).PHP_EOL;
        } else {
            $string .= "DTSTART:".date('Ymd\\THis', strtotime($this->startDate)).PHP_EOL;
            $string .= "DTEND:".date('Ymd\\THis', strtotime($this->endDate)).PHP_EOL;
        }

        $string .= "DTSTAMP:".date('Ymd', strtotime($this->dateStamp)).PHP_EOL;
        $string .= "LAST-MODIFIED:".date('Ymd', strtotime($this->lastModified)).PHP_EOL;
        $string .= "UID:$this->uid".PHP_EOL;
        $string .= "STATUS:$this->status".PHP_EOL;
        $string .= "LOCATION:$this->location".PHP_EOL;
        $string .= "ORGANIZER:$this->organizer".PHP_EOL;
        $string .= "SUMMARY:$this->summary".PHP_EOL;
        $string .= "DESCRIPTION:$this->description".PHP_EOL;

        if ($this->categories) {
            $string .= "CATEGORIES:".implode(',', $this->categories);
        }

        $string .= "END:$this->type".PHP_EOL;

        return str_replace(' ', '', $string);
    }
}
