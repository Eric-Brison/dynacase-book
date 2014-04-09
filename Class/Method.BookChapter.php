<?php
/*
 * @author Anakeen
 * @license http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License
 * @package BOOK
*/
/**
 * Specials methods for CHAPTER family
 */
/**
 * @begin-method-ignore
 * this part will be deleted when construct document class until end-method-ignore
 */
Class _CHAPTER extends Doc
{
    /*
     * @end-method-ignore
    */
    
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
    /**
     * @begin-method-ignore
     * this part will be deleted when construct document class until end-method-ignore
     */
}
/*
 * @end-method-ignore
*/
