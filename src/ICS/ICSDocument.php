<?php

namespace CrixuAMG\Ical\ICS;

use CrixuAMG\Ical\BaseDocument;

class ICSDocument extends BaseDocument
{
    public function addEvent(CalenderEvent $event)
    {
        $this->events[] = $event;
    }

    public function __toString(): string
    {
        $string = 'BEGIN:VCALENDAR'.PHP_EOL;
        $string .= "VERSION:$this->version".PHP_EOL;
        $string .= "METHOD:$this->method".PHP_EOL;
        $string .= "PRODID:$this->identifier".PHP_EOL;

        foreach ($this->getEvents() as $event) {
            /** @var CalenderEvent $event */
            $string .= $event;
        }

        $string .= "END:VCALENDAR";

        return str_replace(' ', '', $string);
    }
}
