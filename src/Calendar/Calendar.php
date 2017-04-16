<?php

namespace Vinter\Calendar;

/**
 * Calendar class for displaying a calendar
 */
class Calendar
{
    /**
     * Properties
     */
    private $weekDays = ["Mån", "Tis", "Ons", "Tor", "Fre", "Lör", "Sön"];
    private $monthNames = [
        "January" => "Januari",
        "February" => "Februari",
        "March" => "Mars",
        "April" => "April",
        "May" => "Maj",
        "June" => "Juni",
        "July" => "Juli",
        "August" => "Augusti",
        "September" => "September",
        "October" => "Oktober",
        "November" => "November",
        "December" => "December"
    ];
    private $year;
    private $month;
    private $currentDay = 0;
    private $daysInMonth;
    private $daysInPrevMonth;
    private $weeksInCalendar = 6;
    private $previousRoute;
    private $nextRoute;
    private $images = [];
    /**
     * Constructor.
     */
    public function __construct($route1, $route2, $date = null)
    {
        if ($date != null) {
            $this->year = date('Y', $date);
            $this->month = date('m', $date);
        } else {
            $this->year = date('Y');
            $this->month = date('m');
        }
        $this->daysInMonth = $this->daysInMonth();
        $this->daysInPrevMonth = $this->daysInPrevMonth();
        $this->previousRoute = $route1;
        $this->nextRoute = $route2;
    }

    /**
     * Get calendar in the form of a table.
     * @return string
     */
    public function getCalendar()
    {
        $date = $this->year . "-" . $this->month . "-01";
        $html = "<div class='calendar'>";
        // Image for month
        if (count($this->images) == 12) {
            $html .= "<img class='calendar-img' src='" .
                $this->images[intval($this->month) - 1] . "'>";
            $html .= "<div class='clear-fix'></div>";
        }
        // Calendar navigation
        $html .= "<a class='pull-left btn btn-primary' href='" .
                $this->previousRoute . "?year=" . $this->year .
                "&month=" . $this->month . "'>" .
                "<span class='glyphicon glyphicon-chevron-left'></span></a>";
        $html .= "<a class='pull-right btn btn-primary' href='" .
                $this->nextRoute . "?year=" . $this->year .
                "&month=" . $this->month ."'>" .
                "<span class='glyphicon glyphicon-chevron-right'></span></a>";
        $html .= "<h2 class='text-center'>" .
                 $this->monthNames[date('F', strtotime($date))] .
                 " " . date('Y', strtotime($date)) . "</h2>";
        // The actual calendar table
        $html .= "<table class='table'><thead><tr>";

        $html .= "</tr></thead><tbody>";
        $html .= $this->weekDays();

        // $weeksInMonth = $this->weeksInMonth();
        for ($i = 0; $i < $this->weeksInCalendar; $i++) {
            $html .= "<tr>";
            for ($j = 1; $j <= 7; $j++) {
                $html .= $this->getDayNumber($i * 7 + $j);
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table></div>";

        return $html;
    }

    /**
     * Get all weekdays (Mon, Tue etc.) for table
     * @return str
     */
    private function weekDays()
    {
        $html = "";
        foreach ($this->weekDays as $day) {
            $html .= "<th>" . $day . "</th>";
        }
        return $html;
    }

    /**
     * Get the number of days for a month
     * @return str
     */
    private function daysInMonth()
    {
        $year = $this->year;
        $month = $this->month;
        return date("t", strtotime($year . '-' . $month . '-01'));
    }

    /**
     * Get the number of the days in previous month
     * @return str
     */
    private function daysInPrevMonth()
    {
        // $prevMonth = $this->month == 1 ? 12 : intval($this->month) - 1;
        // $prevYear = $this->month == 1 ? intval($this->year) - 1 : $this->year;
        $date = mktime(0, 0, 0, $this->month - 1, 1, $this->year);
        // $date = $prevYear . '-' . $prevMonth . '-01';
        return date("t", $date);
    }

    /**
     * Get day number in month for table
     * @param int $tableCell Which cell in table to be created
     * @return str
     */
    private function getDayNumber($tableCell)
    {
        $dayNumber;
        $daysPrevMonth = $this->daysInPrevMonth;
        $notCurrentMonth = false;
        if ($this->currentDay == 0) {
            $firstDay = $this->year . '-' . $this->month . '-01';
            $firstWeekDay = date('N', strtotime($firstDay));

            if (intval($tableCell) == intval($firstWeekDay)) {
                // First day of current month
                $dayNumber = 1;
                $this->currentDay = 2;
            } else {
                // Day number is of previous month
                $notCurrentMonth = true;
                $dayNumber = intval($daysPrevMonth) - intval($firstWeekDay)
                             + intval($tableCell) + 1;
            }
        } elseif ($this->currentDay <= $this->daysInMonth) {
            // Day number is of current month
            $dayNumber = $this->currentDay;
            $this->currentDay++;
        } else {
            // Day number is of next month
            $notCurrentMonth = true;
            $dayNumber = $this->currentDay - $this->daysInMonth;
            $this->currentDay++;
        }

        return "<td class='". ($tableCell % 7 == 0 ? "red-day" : '') .
               ($notCurrentMonth ? " other-month" : '') .
               (date("Y-m-d", strtotime($this->year . '-' . $this->month .
                                        '-' . $dayNumber)) ==
                date("Y-m-d", strtotime("now")) ? " bg-primary" : '') . "'>" .
               $dayNumber . "</td>";
    }

    /**
     * Set urls for $this-images
     * @param [] $url The url for the image
     * @return void
     */
    public function setImages($urls)
    {
        if (count($urls) != 12) {
            throw new Exception("There must be 12 urls sent as parameters" .
                                "with Calendar::setImages()");
        }
        foreach ($urls as $url) {
            $this->images[] = $url;
        }
    }
}
