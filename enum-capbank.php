<?php
$options = array(
    '1' => '✔',
    '0' => 'X',
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>