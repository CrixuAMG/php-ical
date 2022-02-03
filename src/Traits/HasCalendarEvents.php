<?php

namespace CrixuAMG\Ical\Traits;

trait HasCalendarEvents
{
    /**
     * @var array
     */
    protected $events;
    /**
     * @var int
     */
    private $position;

    /**
     * @param  array  $events
     */
    public function __construct(array $events = [])
    {
        $this->position = 0;
        $this->events = $events;
    }

    /**
     * @param  array  $events
     * @return HasCalendarEvents
     */
    public static function create(array $events = [])
    {
        return new static($events);
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events ?? [];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getEvents();
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->events[$this->position];
    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        return $this->position;
    }

    /**
     *
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->events[$this->position]);
    }

    /**
     * @param  mixed  $offset
     * @param  mixed  $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->events[] = $value;
        } else {
            $this->events[$offset] = $value;
        }
    }

    /**
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->events[$offset]);
    }

    /**
     * @param  mixed  $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->events[$offset]);
    }

    /**
     * @param  mixed  $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->events[$offset] ?? null;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->toArray());
    }
}