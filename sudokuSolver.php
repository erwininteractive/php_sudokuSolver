<?php

/**
 * @author Andrew S Erwin
 * @link https://github.com/erwininteractive
 *
 * Backtracking algorithm to solve sudoku puzzles
 */

$puzzle = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 2, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 2, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0]
];

$s = new Sudoku($puzzle);
print $s->arrayToMatrix();

class Sudoku
{
    protected $sudoku = [];

    public function __construct(array $puzzle) {
        $this->sudoku = $puzzle;
        $this->solve();
    }

    private function isPossible(int $x, int $y, int $n): bool {
        foreach (range(0, 8) as $i) {
            if ($this->sudoku[$y][$i] == $n) {
                return false;
            }
        }

        foreach (range(0, 8) as $i) {
            if ($this->sudoku[$i][$x] == $n) {
                return false;
            }
        }

        $x0 = (floor($x / 3) * 3);
        $y0 = (floor($y / 3) * 3);

        foreach (range(0, 2) as $i) {
            foreach (range(0, 2) as $j) {
                if ($this->sudoku[$y0 + $i][$x0 + $j] == $n) {
                    return false;
                }
            }
        }

        return true;
    }

    private function solve(): bool {
        foreach (range(0, 8) as $y) {
            foreach (range(0, 8) as $x) {
                if ($this->sudoku[$y][$x] == 0) {
                    foreach (range(1, 9) as $n) {
                        if ($this->isPossible($x, $y, $n)) {
                            $this->sudoku[$y][$x] = $n;

                            if ($this->solve()) {
                                return true;
                            }

                            $this->sudoku[$y][$x] = 0;
                        }
                    }

                    return false;
                }
            }
        }

        return true;
    }

    public function arrayToMatrix(): void {
        foreach ($this->sudoku as $row) {
            foreach ($row as $node) {
                print $node . " ";
            }

            print PHP_EOL;
        }
    }
}
