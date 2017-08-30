<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2013-2017  Carlos Garcia Gomez  carlos@facturascripts.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Controller;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ExtendedController;
use FacturaScripts\Core\Model;

/**
 * Description of ListArticulo
 *
 * @author carlos
 */
class ListArticulo extends ExtendedController\ListController
{
    public function __construct(&$cache, &$i18n, &$miniLog, $className)
    {
        parent::__construct($cache, $i18n, $miniLog, $className);

        $this->addOrderBy('referencia', 'reference');
        $this->addOrderBy('descripcion', 'description');
        $this->addOrderBy('pvp', 'price');

        $this->model = new Model\Articulo();
    }

    public function privateCore(&$response, $user)
    {
        parent::privateCore($response, $user);
    }
    
    protected function getWhere()
    {
        $result = parent::getWhere();

        if ($this->query != '') {
            $fields = "referencia|descripcion";
            $result[] = new DataBaseWhere($fields, $this->query, "LIKE");
        }

        return $result;
    }

    public function getPageData()
    {
        $pagedata = parent::getPageData();
        $pagedata['title'] = 'Articulos';
        $pagedata['icon'] = 'fa-cubes';
        $pagedata['menu'] = 'almacen';
        
        return $pagedata;
    }
}
