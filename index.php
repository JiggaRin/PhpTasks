<?php

/*
 * Task 1
 * В массиве, содержащем 3 или более чисел, определить подходит ли каждая группа из трех чисел условию a > b < c или a < b > c.
 * Оформить решение в виде функции которая принимает исходный массив и возвращает массив с результатом проверки каждой группы, где 1 удовлетворяет условию и 0 - нет.
*/

function groupCheck(array $nums): array
{
    $resultArr = [];
    foreach ($nums as $key => $num) {
        $slicedArr = array_slice($nums, $key, 3);
        if (count($slicedArr) >= 3) {
            if ($slicedArr[0] > $slicedArr[1] && $slicedArr[1] < $slicedArr[2]) {
                $result = 1;
            } elseif ($slicedArr[0] < $slicedArr[1] && $slicedArr[1] > $slicedArr[2]) {
                $result = 1;
            } else {
                $result = 0;
            }
        } else {
            break;
        }
        array_push($resultArr, $result);
    }
    return $resultArr;
}

$nums = [1, 3, 5, 4, 5, 7];
print_r(groupCheck($nums));


/*
 * Task 2
 * Дана матрица из целых чисел от 1 до 9, размером 3 * N, где N может быть больше либо равна 3.
 * Необходимо определить содержит ли каждый участок матрицы 3 * 3 все числа от 1 до 9.
*/

function checkGroup(array $nums): array
{
    $checkOrder = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $matches = [];
    $length = count($nums[0]);

    for ($a = 0; $a < $length - 2; $a++) {
        $matrixItems = [];
        foreach ($nums as $rows) {
            for ($j = $a; $j < $a + 3; $j++) {
                $matrixItems[] = $rows[$j];
            }
        }
        $diff = array_diff($checkOrder, $matrixItems);
        $matches[] = !count(($diff)) ? 'true' : 'false';
    }
    return $matches;
}

$nums = [
    [1, 2, 3, 2, 7],
    [4, 5, 6, 8, 1],
    [7, 8, 9, 4, 5]
];
print_r(checkGroup($nums));

/*
 * Task 3
 * Есть набор строк (строка это массив из слов), условия форматирования каждой этой строки и лимит символов в строке.
 * Необходимо подготовить текст к публикации, так чтобы он удовлетворял условиям форматирования и не превышал количество символов в строке.
 * Текст должен быть заключен символ * со всех сторон.
*/

function stringCheck(array $textArr, array $formatting, int $strLimit): array
{
    $formattedArr = [];
    array_push($formattedArr, str_repeat('*', 18));

    foreach ($textArr as $key => $item) {
        $text = implode(' ', $item);
        $countStr = strlen($text);

        if ($countStr <= $strLimit) {
            $diff = $strLimit - $countStr;
            if ($formatting[$key] === 'LEFT') {
                array_push($formattedArr, '*' . $text . str_repeat(' ', $diff) . '*');
            } else {
                array_push($formattedArr, '*' . str_repeat(' ', $diff) . $text . '*');
            }
        } else {
            $str = wordwrap($text, 16);
            $str = explode(PHP_EOL, $str);
            foreach ($str as $s) {
                $diff = $strLimit - strlen($s);
                if ($formatting[$key] === 'LEFT') {
                    array_push($formattedArr, '*' . $s . str_repeat(' ', $diff) . '*');
                } else {
                    array_push($formattedArr, '*' . str_repeat(' ', $diff) . $s . '*');
                }
            }
        }
    }
    array_push($formattedArr, str_repeat('*', 18));
    return $formattedArr;
}

$textArr = [
    ['Hello', 'world'],
    ['Brad', 'came', 'to', 'dinner', 'with', 'us'],
    ['He', 'loves', 'tacos']
];
$formatting = ['LEFT', 'RIGHT', 'LEFT'];
$strLimit = 16;
print_r(stringCheck($textArr, $formatting, $strLimit));