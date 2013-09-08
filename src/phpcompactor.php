<?php
/**
 * Compact PHP code.
 *
 * Strip comments, combine entire library into one file.
 *
 * Modified by Jurriaan Pruis - Better 'compression'
 *
 **/
 
require_once('lib/compactor.php');

if ($argc < 3) {
  print "Strip unnecessary data from PHP source files.\n\n\tUsage: php phpcompactor.php DESTINATION.php SOURCE.php\n";
  exit;
}
 
$source = $argv[2];
$target = $argv[1];
print "Compacting $source into $target.\n";
$compactor = new Compactor($target);

//$compactor->exclude(array('*'));
//print_r($compactor->getExcludedFiles());
/*
// Use filters like this (Useable for things like stripping debug-only logging):
$compactor->setFilter(function ($in)
{
  $in = preg_replace('/.*\/\/ DEBUG ONLY/','',$in);
  return preg_replace('/.*->logger->.*\/','',$in);
});
*/
$compactor->exclude('framework.php');
$compactor->compactAll($source);


$compactor->report();
$compactor->close();
