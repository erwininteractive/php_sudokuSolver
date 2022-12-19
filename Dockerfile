FROM php:latest
ADD sudokuSolver.php /

CMD ["php", "./sudokuSolver.php"]
