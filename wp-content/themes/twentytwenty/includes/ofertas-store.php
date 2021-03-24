<?php

/**
 * 
 * This class handles cursos storage
 * 
 */
 class OfertasStore {
    
    /**
     * This method handles storage to db
     * @param object $wpdb
     * @param object $postedData
     * @return boolean
     * 
     */
    public static function store($wpdb, $posted_data){
        
        $store_array = [];
        
        try {
            
            $store_array = array_merge($store_array, [
                "nombre" => $posted_data["nombre"],
                "correo" => $posted_data["correo"],
                "telefono" => $posted_data["telefono"],
                "pais" => $posted_data["pais"][0],
                "cargo_requerido" => $posted_data["cargo_requerido"],
                "especificacion" => $posted_data["especificacion"],
                "observaciones" => $posted_data["observaciones"]
            ]);
            
            return $wpdb->insert('ofertas_laborales', $store_array);
            
        } catch(Exception $e){
            return false;
        }
    }
    
    /**
     * 
     * This method handles data requests
     * @param object $wpdb
     * @param boolean $isMember
     * @return string
     *
     */
    public static function getData($wpdb, $isMember){
        $html = 
        '<div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Tel&eacute;fono</th>
                        <th scope="col">Pa&iacute;s</th>
                        <th scope="col">Cargo requerido</th>
                        <th scope="col">Especificaci&oacute;n</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
            <tbody>';
        
        
        if($isMember){
            $results = $wpdb->get_results("SELECT nombre, correo, telefono, pais, cargo_requerido, especificacion, observaciones FROM ofertas_laborales");
        
            foreach($results as $result){
                $html.= "<tr>";
                $html.= "<td>{$result->nombre}</td>";
                $html.= "<td>{$result->correo}</td>";
                $html.= "<td>{$result->telefono}</td>";
                $html.= "<td>{$result->pais}</td>";
                $html.= "<td>{$result->cargo_requerido}</td>";
                $html.= "<td>{$result->especificacion}</td>";
                $html.= "<td>{$result->observaciones}</td>";
                $html.= "</tr>";
            }
            
            $html.= "</tbody></table></div>";
            
        } else {
             $results = $wpdb->get_results("SELECT nombre, pais, cargo_requerido FROM ofertas_laborales LIMIT 3");
        
            foreach($results as $result){
                  $html.= "<tr>";
                $html.= "<td>{$result->nombre}</td>";
                $html.= "<td></td>";
                $html.= "<td></td>";
                $html.= "<td>{$result->pais}</td>";
                $html.= "<td>{$result->cargo_requerido}</td>";
                $html.= "<td></td>";
                $html.= "<td></td>";
                $html.= "</tr>";
            }
            
             $html.= "</tbody>
                    </table>
                </div>
                <br />
                <br />
                <h4>Debe acceder para ver la informaci&oacute;n m&aacute;s completa</h4>
                <br />
                <br />
                <button onclick=\"window.location.replace('/acceso')\">Acceder</button>";
        }
        
        return $html;
    }
         
 }

?>