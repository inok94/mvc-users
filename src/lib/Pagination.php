<?php
/**
 * Created by PhpStorm.
 * User: Inok94
 * Date: 7/10/2019
 * Time: 6:14 PM
 */

namespace App\src\lib;


class Pagination
{

    private $max = 10;
    private $route;
    private $index = '';
    private $current_page;
    private $total;
    private $limit;

    public function __construct($route, $total, $limit = 10)
    {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }

    public function get()
    {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">' . $page . '</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, 'Next') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Back');
            }
        }
        $html .= $links . ' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null): string
    {
        if (!$text) {
            $text = $page;
        }
        return '<li class="page-item"><a class="page-link" href="/' . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . $text . '</a></li>';
    }

    private function limits(): array
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    private function setCurrentPage()
    {
        if (isset($this->route['page'])) {
            $currentPage = $this->route['page'];
        } else {
            $currentPage = 1;
        }
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}