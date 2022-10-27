<?php

function varToConsole ($name, $value)
{
	echo "<script>console.log('" . $name . ": " . json_encode ($value) . "')</script>";
}

function msgToConsole ($msg)
{
	echo "<script>console.log('" . $msg . "')</script>";
}

?>
