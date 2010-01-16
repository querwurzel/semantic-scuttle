<?php
/**
 * SemanticScuttle - your social bookmark manager.
 *
 * PHP version 5.
 *
 * @category Bookmarking
 * @package  SemanticScuttle
 * @author   Christian Weiske <cweiske@cweiske.de>
 * @license  GPL http://www.gnu.org/licenses/gpl.html
 * @link     http://sourceforge.net/projects/semanticscuttle
 */
require_once '../src/SemanticScuttle/header.php';

if (!isset($_SERVER['PATH_INFO'])) {
    header('HTTP/1.0 400 Bad Request');
    header('Content-Type: text/plain');
    echo 'Short URL name missing';
    exit();
}

list($url, $short) = explode('/', $_SERVER['PATH_INFO']);

$bs = SemanticScuttle_Service_Factory::get('Bookmark');
$bookmark = $bs->getBookmarkByShortname($short);
if ($bookmark === false) {
    header('HTTP/1.0 404 Not found');
    header('Content-Type: text/plain');
    echo 'No bookmark found with short name of: ' . $short;
    exit();
}

header('HTTP/1.0 302 Found');
header('Location: ' . $bookmark['bAddress']);
?>