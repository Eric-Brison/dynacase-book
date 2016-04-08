<?php
/*
 * @author Anakeen
 * @package BOOK
*/

function lbookstates($dbaccess, $docid, $name = "")
{
    $doc = \Dcp\DocManager::getDocument($docid, false);
    $tr = array();
    $staticstates = array(
        "_fixed_" . " (" . _("fixed revision") . ")",
        "_latest_" . " (" . _("latest revision") . ")"
    );
    foreach ($staticstates as $v) {
        $tr[] = array(
            $v,
            $v
        );
    }
    
    if ($doc !== null && $doc->isAlive() && $doc->wid) {
        $wdoc = \Dcp\DocManager::getDocument($doc->wid, false);
        /* @var $wdoc WDoc */
        if ($wdoc !== null && method_exists($wdoc, "getStates")) {
            $states = $wdoc->getStates();
            $pattern = preg_quote($name);
            foreach ($states as $v) {
                if (($name == "") || (preg_match("/$pattern/i", $v, $reg))) $tr[] = array(
                    $v . ' (' . _($v) . ')',
                    $v . ' (' . _($v) . ')'
                );
            }
        }
    }
    return $tr;
}
