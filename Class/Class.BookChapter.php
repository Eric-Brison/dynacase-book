<?php
/*
 * @author Anakeen
 * @package BOOK
*/
/**
 * Specials methods for CHAPTER family
 */
namespace Dcp\Book;

Class Chapter extends \Dcp\Family\Document
{
    function preCreated()
    {
        $book = \Dcp\DocManager::getDocument($this->getRawValue("chap_bookid"));
        if ($book !== null && $book->isAlive()) {
            if ($book->control("modify") == "") {
                return "";
            }
        }
        
        return _("need modify acl in book");
    }
    
    function postModify()
    {
        $html = $this->getRawValue("chap_content");
        $html = preg_replace('/<font([^>]*)face="([^"]*)"/is', "<font\\1", $html); //delete font face
        $this->setValue("chap_content", $html);
        $err = $this->modify();
        return $err;
    }
}
