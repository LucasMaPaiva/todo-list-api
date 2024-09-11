<?php

function removeMask($value): ?string
{
    if (!$value) {
        return null;
    }
    return str_replace(['.', '-', '/', '(', ')', ' '], '', $value);
}

function translateDate($date): string
{
    $date = str_replace(['year'], 'ano', $date);
    $date = str_replace(['years'], 'anos', $date);
    $date = str_replace(['mons'], 'meses', $date);
    $date = str_replace(['month'], 'mês', $date);
    $date = str_replace(['mon'], 'mês', $date);
    $date = str_replace(['day'], 'dia', $date);
    return str_replace(['days'], 'dias', $date);
}

function makeMask($val, $mask): string
{
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) $maskared .= $val[$k++];
        } else {
            if (isset($mask[$i])) $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

if (!function_exists('maskEmail')) {
    function maskEmail($value): string
    {
        $parts = explode("@", $value);

        $user = $parts[0];
        $domain = $parts[1];

        $user_length = strlen($user);
        $mask_percentage = 10;

        $masked_length = (int)($user_length * ($mask_percentage / 100));

        $start = substr($user, 0, 3);
        $masked_middle = str_repeat(
            "*",
            strlen($user) - $user_length / 2 - $masked_length
        );
        return $start . $masked_middle . "@" . $domain;
    }
}

if (!function_exists('nullVal')) {
    function nullVal($value): mixed
    {
        if (boolval($value)) {
            return $value;
        }

        return null;
    }
}
