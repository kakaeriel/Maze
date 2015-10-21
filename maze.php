<?php

/**
 * Maze
 * 
 * @author     Ibnuh Hairil <kakaeriel@gmail.com>
 */
class Maze {

    public $maze = array();
    public $countOutput = 4;
    public $direction = ['D', 'R', 'U', 'L'];
    public $x = 0;
    public $y = 1;

    /**
     * 
     * Construct Class
     *
     * @param integer $size Count cell for row and column
     */
    public function __construct($size = null) {
        echo '<style>.cell{width:15px;height:5px;float:left}</style>';
        for ($a = 0; $a < $this->countOutput; $a++) {
            if ($size < 3) {
                echo 'Can\'t create Maze ';
                return false;
            }

            for ($x = 0; $x < $size; $x++) {
                for ($y = 0; $y < $size; $y++) {
                    $this->maze[$a][$x][$y] = '@';
                }
            }
        }
    }

    /**
     * 
     * A function for set latest position
     *
     * @param integer $x Coordinate X
     * @param integer $y Coordinate Y
     */
    public function setPosition($x = 0, $y = 1) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * 
     * A function for get next position
     *
     * @param integer $block Set maze position
     * @param integer $x Coordinate X
     * @param integer $y Coordinate Y
     */
    public function validate($block, $x, $y) {
        foreach ($this->direction as $direction) {
            switch ($direction) {
                case 'D':
                    $y1 = $y + 1;
                    $y2 = $y + 2;

                    if ($x > 0 && $y1 > 0) {
                        if (isset($this->maze[$block][$x][$y1]) && isset($this->maze[$block][$x][$y2])) {
                            $cell = $this->maze[$block][$x][$y1];
                            $cell2 = $this->maze[$block][$x][$y2];

                            if ($cell == '@' && $cell2 == '@') {
                                if ($this->validateNext($block, $x, $y1)) {
                                    $this->maze[$block][$x][$y1] = ' ';
                                    $this->setPosition($x, $y1);
                                    return true;
                                }
                            }
                        }
                    }
                    break;
                case 'R':
                    $x1 = $x + 1;
                    $x2 = $x + 2;

                    if ($x1 > 0 && $y > 0) {
                        if (isset($this->maze[$block][$x1][$y]) && isset($this->maze[$block][$x2][$y])) {
                            $cell = $this->maze[$block][$x1][$y];
                            $cell2 = $this->maze[$block][$x2][$y];

                            if ($cell == '@' && $cell2 == '@') {
                                if ($this->validateNext($block, $x1, $y)) {
                                    $this->maze[$block][$x1][$y] = ' ';
                                    $this->setPosition($x1, $y);
                                    return true;
                                }
                            }
                        }
                    }

                    break;
                case 'L':
                    $x1 = $x - 1;
                    $x2 = $x - 2;

                    if ($x1 > 0 && $y > 0) {
                        if (isset($this->maze[$block][$x1][$y]) && isset($this->maze[$block][$x2][$y])) {
                            $cell = $this->maze[$block][$x1][$y];
                            $cell2 = $this->maze[$block][$x2][$y];

                            if ($cell == '@' && $cell2 == '@') {
                                if ($this->validateNext($block, $x1, $y)) {
                                    $this->maze[$block][$x1][$y] = ' ';
                                    $this->setPosition($x1, $y);
                                    return true;
                                }
                            }
                        }
                    }

                    break;
                case 'U':
                    $y1 = $y - 1;
                    $y2 = $y - 2;

                    if ($x > 0 && $y1 > 0) {
                        if (isset($this->maze[$block][$x][$y1]) && isset($this->maze[$block][$x][$y2])) {
                            $cell = $this->maze[$block][$x][$y1];
                            $cell2 = $this->maze[$block][$x][$y2];

                            if ($cell == '@' && $cell2 == '@') {
                                if ($this->validateNext($block, $x, $y1)) {
                                    $this->maze[$block][$x][$y1] = ' ';
                                    $this->setPosition($x, $y1);
                                    return true;
                                }
                            }
                        }
                    }
                    break;

                default:

                    break;
            }
        }

        return false;
    }

    /**
     * 
     * A function for validate next position
     *
     * @param integer $block Set maze position
     * @param integer $x Coordinate X
     * @param integer $y Coordinate Y
     */
    public function validateNext($block, $x, $y) {
        $count = 0;
        foreach ($this->direction as $direction) {
            switch ($direction) {
                case 'D':
                    $y1 = $y + 1;

                    if (isset($this->maze[$block][$x][$y1])) {
                        $cell = $this->maze[$block][$x][$y1];

                        if ($cell == '@') {
                            $count++;
                        }
                    }
                    break;
                case 'R':
                    $x1 = $x + 1;

                    if (isset($this->maze[$block][$x1][$y])) {
                        $cell = $this->maze[$block][$x1][$y];

                        if ($cell == '@') {
                            $count++;
                        }
                    }

                    break;
                case 'L':
                    $x1 = $x - 1;

                    if (isset($this->maze[$block][$x1][$y])) {
                        $cell = $this->maze[$block][$x1][$y];

                        if ($cell == '@') {
                            $count++;
                        }
                    }

                    break;
                case 'U':
                    $y1 = $y - 1;

                    if (isset($this->maze[$block][$x][$y1])) {
                        $cell = $this->maze[$block][$x][$y1];

                        if ($cell == '@') {
                            $count++;
                        }
                    }
                    break;

                default:

                    break;
            }
        }

        if ($count > 2) {
            return true;
        }

        return false;
    }

    /**
     * 
     * A function for create Maze
     *
     * @param integer $block Set maze position
     */
    public function create($block) {
        $loop = true;
        $this->maze[$block][$this->x][$this->y] = ' ';

        while ($loop == true) {
            if ($this->validate($block, $this->x, $this->y) == false) {
                $loop = false;
            }
        }
    }

    /**
     * 
     * A function for display Maze
     *
     */
    public function display() {
        foreach ($this->maze as $block => $maze) {
            $this->create($block);
            shuffle($this->direction);
            $this->setPosition();
        }

        foreach ($this->maze as $block => $maze) {
            echo 'Maze ' . ($block + 1) . '<br/>';
            foreach ($maze as $m) {
                foreach ($m as $n) {
                    echo '<span class="cell">' . $n . '</span>';
                }
                echo '<br>';
            }

            echo '<br>';
        }
    }

}

$maze = new Maze(15);
$maze->display();
