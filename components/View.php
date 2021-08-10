<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SampleWebApp\components;

class View
{

   
    public function __construct()
    {
        
    }

    public function render($layout = 'main', $view = "", $params=[]){

        $layoutContent = $this->layout($layout, $params);
        
        $viewContent = $this->view($view, $params);
                
        return str_replace('{{VIEW}}', $viewContent, $layoutContent);
    }

    protected function layout($layout = 'main', $params){
        foreach($params as $key => $value){
            $$key = $value;
        }   
        ob_start();        
        include_once "views/layouts/$layout.php";        
        return ob_get_clean();
    }

    protected function view($view, $params){                
        foreach($params as $key => $value){            
            $$key = $value;            
        }   
                 

        ob_start();        
        include_once "views/publicPages/$view/view.php";        
        return ob_get_clean();
    }  
    
}
