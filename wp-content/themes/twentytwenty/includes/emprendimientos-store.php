<?php

/**
 * 
 * This class handles emprendimientos storage
 * 
 */
 class EmprendimientosStore {
    
    /**
     * This method handles storage to db
     * @param object $wpdb
     * @param array $postedData
     * @param array $uploadedFiles
     * @return boolean
     * 
     */
    public static function store($wpdb, $posted_data, $uploaded_files){
        
        $store_array = [];
        
        try {
            
            $store_array = array_merge($store_array, [
                "nombre" => $posted_data["nombre"],
                "correo" => $posted_data["correo"],
                "telefono" => $posted_data["telefono"],
                "pais" => $posted_data["pais"][0],
                "comentarios" => $posted_data["comentarios"],
                "pagina_web" => $posted_data["pagina_web"],
                "autorizado_a_compartir" => ($posted_data["autorizado_a_compartir"][0] == "Si") ? true : false
            ]);
            
            
            if(null !== $uploaded_files["logo"]){
                
                $path = $uploaded_files["logo"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                
                $store_array = array_merge($store_array, ["logo" => $base64]);
            }
            if(null !== $uploaded_files["foto_producto_servicio"]){
                $path = $uploaded_files["foto_producto_servicio"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                
                 $store_array = array_merge($store_array, ["foto_producto_servicio" => $base64]);
            }
            
            return $wpdb->insert('emprendimientos', $store_array);
            
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
                        <th scope="col">P&aacute;gina web</th>
                        <th scope="col">Comentarios</th>
                    </tr>
                </thead>
            <tbody>';
        
        if($isMember){
             $results = $wpdb->get_results("SELECT nombre, correo, telefono, pais, pagina_web, comentarios FROM emprendimientos WHERE autorizado_a_compartir = 1");
        
            foreach($results as $result){
                $html.= "<tr>";
                $html.= "<td>{$result->nombre}</td>";
                $html.= "<td>{$result->correo}</td>";
                $html.= "<td>{$result->telefono}</td>";
                $html.= "<td>{$result->pais}</td>";
                $html.= "<td>{$result->pagina_web}</td>";
                $html.= "<td>{$result->comentarios}</td>";
                $html.= "</tr>";
            }
            
            $html.= "</tbody></table></div>";
        } else {
             $results = $wpdb->get_results("SELECT nombre, pais, pagina_web FROM emprendimientos WHERE autorizado_a_compartir = 1 LIMIT 3");
        
            foreach($results as $result){
                $html.= "<tr>";
                $html.= "<td>{$result->nombre}</td>";
                $html.= "<td></td>";
                $html.= "<td></td>";
                $html.= "<td>{$result->pais}</td>";
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