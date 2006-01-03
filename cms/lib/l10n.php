<?php
$input = new FileReader($dr."/languages/russian.mo");
$l10n = new gettext_reader($input);

function __($text) {
  global $l10n;
  return $l10n->translate($text);
}

function __ngettext($single, $plural, $number) {
  global $l10n;
  return $l10n->ngettext($single, $plural, $number);
}
?>