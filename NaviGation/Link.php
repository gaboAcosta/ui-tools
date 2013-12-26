<?php
/**
 * User: Gabriel Acosta
 * Date: 12/21/13
 * Time: 11:11 AM
 */

namespace GaboAcosta\UITools\Navigation;


class Link implements DOMNodeInteface {
    protected $href;
    protected $text;
    protected $selected = false ;
    protected $classes = array();

    public function getDOMNode(){
        //change this for its own method
        $this->domNode->setAttribute('class',$this->getClassName());
        return $this->domNode;
    }

    protected function getClassName(){
        $className = "";
        foreach($this->classes as $class){
            $className.=" $class";
        }
        return $className;
    }


    public function __construct($text,$href,\DOMDocument $dom){


        $this->uri=  \Request::url();
        $this->href = $href;
        $this->dom =  $dom;
        $this->domNode = $this->dom->createElement('li');
        //pendiente para poner active
        $link = $this->dom->createElement('a');
        if($this->checkActive())
            $this->classes[] = 'active';
        $this->text = $link->nodeValue = $text;
        $link->setAttribute('href',$href);
        $this->domNode->appendChild($link);

    }

    public function addNotch(){
        $notch = $this->dom->createElement('b');
        $notch->setAttribute('class','notch hide-for-small-only');
        $this->domNode->appendChild($notch);
    }

    public function addClass($class){
        $this->classes[] = $class;
    }

    public function checkActive(){
        if($this->uri == $this->href){
            return true;
        } else {
            return false;
        }
    }





    public function setHref($href)
    {
        $this->href = $href;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    public function toggleSelected()
    {
        $this->selected = !$this->selected;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }



}