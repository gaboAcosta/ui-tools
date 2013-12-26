<?php

namespace GaboAcosta\UITools\Navigation;

/**
 * User: Gabriel Acosta
 * Date: 12/21/13
 * Time: 11:00 AM
 */



class NavBar {

    protected $items = array();
    protected $title;
    protected $logo_url;
    protected $curr_section;
    protected $curr_page;
    protected $routes = array();
    protected $dom;
    protected $nav;

    public function setup(){
        $dom = $this->getDOM();

        $this->nav = $dom->createElement('nav');
        $this->nav->setAttribute('class','top-bar');
        $this->nav->setAttribute('data-topbar',null);
        $dom->appendChild($this->nav);
        $ul = $this->getHeader();
        $this->nav->appendChild($ul);

        $this->getBody();

    }

    protected function getDOM(){
        if(!$this->dom)
            $this->dom =  new \DOMDocument('1.0');
        return $this->dom;
    }

    /**
     * GetHeader
     *
     * This method constructs the HTML needed for the
     * header of the foundation navBar
     * @return UL
     */

    protected function getHeader(){

        $dom = $this->getDOM();
        $ul = $dom->createElement('ul');
        $ul->setAttribute('class','title-area show-for-small-only');
        $li = $dom->createElement('li');
        $li->setAttribute('class','name');
        $ul->appendChild($li);
        $h1 = $dom->createElement('h1');
        $li->appendChild($h1);
        $link = $dom->createElement('a');
        $link->setAttribute('href','#');
        $h1->appendChild($link);
        $logo = $dom->createElement('img');
        $logo->setAttribute('src','/app/images/logo.png');
        $logo->setAttribute('class',"title-logo");
        $logo->setAttribute('alt','Logotipo Picacho');
        $link->appendChild($logo);
        $toggle = $dom->createElement('li');
        $toggle->setAttribute('class','toggle-topbar menu-icon');
        $ul->appendChild($toggle);
        $toggleLink = $dom->createElement('a');
        $toggleLink->setAttribute('href','#');
        $toggle->appendChild($toggleLink);
        $text = $dom->createElement('span');
        $text->nodeValue = "Menu";
        $toggleLink->appendChild($text);
        return $ul;
    }

    protected function getBody(){
        $dom = $this->getDOM();
        $section = $dom->createElement('section');
        $section->setAttribute('class','top-bar-section');
        $this->nav->appendChild($section);
        $itemsContainer = $dom->createElement('ul');

        //Change this if you want your menu aligned differently
        $itemsContainer->setAttribute('class','right');

        $section->appendChild($itemsContainer);

        if(empty($this->items))
            $this->loadItems();

        foreach($this->items as $item){
            $itemsContainer->appendChild($item->getDOMNode());
        }
    }

    protected function getItemsList(){
        return \Config::get('navBar.routes');
    }

    protected function loadItems(){
        $items = $this->getItemsList();
        foreach($items as $item){
            if($item['type'] == 'link'){
                $link = $this->buildLink($item);
                $this->items[] = $link;
            } else {
                $this->items[] = $this->buildMenu($item);
            }
        }
    }

    protected function buildLink($data){
        $route = $data['route']['implemented'];


        if($route){
            $href = \URL::route($data['route']['alias']);
        } else {
            $href = '#';
        }

        return new Link($data['text'],$href,$this->getDOM());


    }

    protected function buildMenu($data){
        $menu = new Menu($data['text'],$this->getDOM());


        $first = true;
        foreach($data['elements'] as $link){
            $newLink = $this->buildLink($link);
            if($first){
                $first = false;
                $newLink->addClass('first-menu');
                $newLink->addNotch();
            }

            $menu->attach($newLink);
        }
        return $menu;
    }




    protected function addItem(Rendereable $item){
        $this->items[] = $item;
    }

    public function getHTML(){
        return $this->dom->saveHTML();
    }

    public function render(){
        $this->setup();
        $html = $this->getHTML();

        return $html;
    }

}