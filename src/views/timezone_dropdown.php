<?php

echo "<select id='timezone' name='timezone'>";
foreach($tz_array as $array)
{
echo "<option data-int_offset=". $array['int_offset'] ."
 value=". $array['timezone_id'] .">" .
 "(" . $array['offset'] . ")" . $array['timezone_id'] .
 "</option>";
}
echo "</select>";





