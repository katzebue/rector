<?php

$value = null;

if (is_null($value)) {
    echo 'Value is null';
}

if (!is_null($value)) {
    echo 'Value is not null';
}

?>
-----
<?php

$value = null;

if ($value === null) {
    echo 'Value is null';
}

if ($value !== null) {
    echo 'Value is not null';
}

?>
