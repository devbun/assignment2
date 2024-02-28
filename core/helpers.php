<?php

function image(string $filename): string {
	return "/images/$filename";
}

function hsc($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}