<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test_task_3</title>
</head>

<body>

    <h2>Входные данные</h2>
    <form name="enterForm" method="GET" action="<?= $_SERVER['PHP_SELF'] ?>">
        <table>
            <tbody>
                <tr>
                    <td>
                        <b>Введите n:</b>
                    </td>

                    <td>
                        <b><input type="text" name="n"></b>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Введите k:</b>
                    </td>

                    <td>
                        <input type="text" name="k">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><input type="submit"></b>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <h2>Выходное число: </h2>

    <?php

    $p_str = isset($_GET['n']) ? $_GET['n'] : 0;
        $t_str = isset($_GET['k']) ? $_GET['k'] : 0;
            $n_str = (int) $p_str;
                $k_str = (int) $t_str;


    function add_prev($n_str, $k_str)
    {
        function count_added_strings($str_len, $n_str, $k_str)
        {
            $num_beg = 10 ** ($str_len - 1);
            $num_end = $k_str * 10 ** ($str_len - strlen($k_str)) - 1;
            if ($str_len == strlen($n_str)) {
                $num_end = min($num_end, $n_str);
                return $num_end - $num_beg + 1;
            }
        }
        $res = 0;
        foreach (range(strlen($k_str) + 1, strlen($n_str) + 1) as $str_len) {
            $res += count_added_strings($str_len, $n_str, $k_str);
        }
        return $res;
    }

    function remove_prev($k_str)
    {
        function count_deleted_strings_with_k_dig($k_str)
        {
            $res = 0;
            foreach (range(2, strlen($k_str)) as $str_len) {
                $res += ($k_str[0] + 1) * 10 ** ($str_len - 1) - 1 - $k_str[$str_len];
            }
            return $res;
        }
        function count_deleted_strings_with_digits_greater($k_str)
        {
            if (strlen($k_str) == 1) {
                return 0;
            }
            $p_str = (string) $k_str;
            return (9 - $p_str[0]) * '1' * (strlen($p_str) - 1);
        }
        $res = 0;
        $res += count_deleted_strings_with_digits_greater($k_str);
        return $res;
    }
    if (($t_str > $p_str) || (empty($t_str)) || (empty($p_str)) || (!is_numeric($t_str)) || (!is_numeric($p_str)) || ($t_str < 0) || ($p_str < 0))
        echo "Введите корректные входные данные...";
    else {
        $result = $k_str + add_prev($n_str, $k_str) - remove_prev($k_str);
        if (is_nan($result))
            echo "Слишком большие числа...";
        else echo "Результат: ", $result;
    }
    ?>

</body>

</html>