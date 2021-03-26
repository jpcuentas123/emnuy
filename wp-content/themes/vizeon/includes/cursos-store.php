<?php

/**
 * 
 * This class handles cursos storage
 * 
 */
 class CursosStore {
    
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
            
            $temas = "";
            
            foreach($posted_data["temas"] as $tema){
                $temas.= "$tema;";
            }
            
            $store_array = array_merge($store_array, [
                "temas" => $temas,
                "otro" => $posted_data["otro"],
            ]);
            
            return $wpdb->insert('cursos', $store_array);
            
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
    public static function getData($wpdbm, $isMember){
        $html = 
        '<div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Temas</th>
                        <th scope="col">Otro</th>
                    </tr>
                </thead>
            <tbody>';
        
        if($isMember){
            $results = $wpdb->get_results("SELECT temas, otro FROM cursos");
        
            foreach($results as $result){
                $html.= "<tr>";
                $html.= "<td>{$result->temas}</td>";
                $html.= "<td>{$result->otro}</td>";
                $html.= "</tr>";
            }
            
             $html.= "</tbody></table></div>";
        
        } else {
             $results = $wpdb->get_results("SELECT temas, otro FROM cursos LIMIT 3");
        
            foreach($results as $result){
                $html.= "<tr>";
                $html.= "<td>{$result->temas}</td>";
                $html.= "<td>{$result->otro}</td>";
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