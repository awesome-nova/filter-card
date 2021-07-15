<?php

namespace AwesomeNova\Cards;

use Laravel\Nova\Card;
use Laravel\Nova\Filters\Filter;

class FilterCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * NovaFilterTool constructor.
     * @param Filter|string $filter
     */
    public function __construct($filter)
    {
        parent::__construct('awesome-nova-filter-card');

        if ($filter instanceof Filter) {
            $filter = $filter->key();
        }

        $this->withMeta(['filter' => $filter]);
    }

    public function showAsSelect($show_as_select = true)
    {
        $this->withMeta(['show_as_select' => $show_as_select]);

        return $this;
    }

    public function hideSelectHeading($hide_select_heading = true)
    {
        $this->withMeta(['hide_select_heading' => $hide_select_heading]);

        return $this;
    }
}
