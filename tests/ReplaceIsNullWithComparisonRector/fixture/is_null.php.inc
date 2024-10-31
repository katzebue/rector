<?php

$value = null;

if (is_null($value)) {
    echo 'Value is null';
}

?>
-----
<?php

$value = null;

if ($value === null) {
    echo 'Value is null';
}

?>
