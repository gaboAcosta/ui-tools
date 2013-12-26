<?php
return array(
    'routes' => array(
        'Simple Link' => array(
            'type' => 'link',
            'text'        => 'Home',
            'route' => array(
                'alias'       => 'home',
                'implemented' => false
            ),

        ),
        'A Menu' => array(
            'type' => 'menu',
            'text' => 'Foo',
            'elements' => array(
                'First Element' => array(
                    'type' => 'link',
                    'text'        => 'First Element',
                    'route' => array(
                        'alias'       => 'first-element',
                        'implemented' => false,
                    ),
                ),
                'Second Element' => array(
                    'type' => 'link',
                    'text'        => 'Second Element',
                    'route' => array(
                        'alias'       => 'second-element',
                        'implemented' => false,
                    ),
                ),
            ),
        ),

    )
);