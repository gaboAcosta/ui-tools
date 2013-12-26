<?php
/**
 * User: Gabriel Acosta
 * Date: 12/21/13
 * Time: 10:59 AM
 */
namespace GaboAcosta\UITools\Navigation;

class Menu implements DOMNodeInterface {

    protected $dom;
    protected $domNode;
    protected $body;
    protected $items;
    protected $active;

    public function __construct($text,\DOMDocument $dom){
        $this->dom =  $dom;
        $this->domNode = $this->dom->createElement('li');
        //pendiente para poner active

        $title = $this->dom->createElement('a');
        $title->nodeValue = $text;
        $this->domNode->appendChild($title);



        $this->body = $this->dom->createElement('ul');
        $this->body->setAttribute('class','dropdown');

        $this->domNode->appendChild($this->body);



    }

    public function attach(Link $link){
        //I attach it first to a list in case I want to dynamically add or remove items
        //perhaps later I'll want to delete in an ACL ?

        $this->items[$link->getText()] = $link;
        $this->body->appendChild($this->items[$link->getText()]->getDOMNode());
    }

    public function getDOMNode(){
        $this->checkActive();
        return $this->domNode;
    }

    public function checkActive(){
        foreach($this->items as $item){
            if($item->checkActive()){
                $this->active = true;
            }
        }
        if($this->active){
            $this->domNode->setAttribute('class','has-dropdown active');
        } else {
        $this->domNode->setAttribute('class','has-dropdown');
        }
    }



}