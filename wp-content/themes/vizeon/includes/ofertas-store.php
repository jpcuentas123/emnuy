<?php

/**
 *
 * This class handles cursos storage
 *
 */
class OfertasStore
{

    /**
     * This method handles storage to db
     * @param object $wpdb
     * @param object $postedData
     * @return boolean
     *
     */
    public static function store($wpdb, $posted_data)
    {

        $store_array = [];

        try {

            $store_array = array_merge($store_array, [
                "nombre" => $posted_data["nombre"],
                "correo" => $posted_data["correo"],
                "telefono" => $posted_data["telefono"],
                "pais" => $posted_data["pais"][0],
                "cargo_requerido" => $posted_data["cargo_requerido"],
                "especificacion" => $posted_data["especificacion"],
                "observaciones" => $posted_data["observaciones"],
            ]);

            return $wpdb->insert('ofertas_laborales', $store_array);

        } catch (Exception $e) {
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
    public static function getData($wpdb, $isMember)
    {
        $html =
            '
            <div class="elementor-element elementor-element-e9a3ead elementor-widget elementor-widget-gva-teams" data-id="e9a3ead"
    data-element_type="widget" data-widget_type="gva-teams.default">
                <div class="elementor-widget-container">
                    <div class="gva-element-gva-teams gva-element">
                        <div class="gva-teams-grid clearfix grid-jre2">
                            <div class="gva-content-items">
                                <div class="lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-1">';

        if ($isMember) {
            $results = $wpdb->get_results("SELECT nombre, correo, telefono, pais, cargo_requerido, especificacion, observaciones FROM ofertas_laborales");

            foreach ($results as $result) {
                // $html .= "<tr>";
                // $html .= "<td></td>";
                // $html .= "<td>{$result->correo}</td>";
                // $html .= "<td>{$result->telefono}</td>";
                // $html .= "<td>{$result->pais}</td>";
                // $html .= "<td>{$result->cargo_requerido}</td>";
                // $html .= "<td>{$result->especificacion}</td>";
                // $html .= "<td>{$result->observaciones}</td>";
                $html .= "
                <style>
                    .job-item{
                        padding: 5px 0px;
                        text-align: center;
                        font-weight: 400;
                        font-family: 'Poppins', sans-serif;
                        font-size: 14px;
                    }
                    .job-item-title{
                        font-weight: 600;
                    }
                </style>
                <div class='item-columns'>
                    <div class='team-block team-v2 '>
                        <div class='team-image'>
                            <a href='#'><img
                                    width='450' height='500'
                                    src='http://embajadores.projectsw2t.net/wp-content/uploads/2020/12/logo-universidad-yacambu.png'
                                    class='attachment-post-thumbnail size-post-thumbnail wp-post-image' alt=''
                                    loading='lazy'></a>
                        </div>
                        <div class='team-content'>
                            <div class='team-content-inner' style='padding:60px 0px 50px;'>
                                <div class='team-job' style='font-size: 18px; padding-bottom: 5px;'>
                                    {$result->cargo_requerido}
                                </div>
                                <div class='team-name' style='padding-bottom: 5px !important;'>
                                        {$result->nombre}
                                </div>
                                <div class='job-item-title'>
                                    <span>Correo</span>
                                </div>
                                <div class='job-item job-email'>
                                    {$result->correo}
                                </div>
                                <div class='job-item-title'>
                                    <span>Telefono</span>
                                </div>
                                <div class='job-item job-tel'>
                                    {$result->telefono}
                                </div>
                                <div class='job-item-title'>
                                    <span>País</span>
                                </div>
                                <div class='job-item job-country'>{$result->pais}</div>
                                <div class='job-item-title'>
                                    <span>Especificaciones</span>
                                </div>
                                <div class='job-item job-specification'>{$result->especificacion}</div>
                                <div class='job-item-title'>
                                    <span>Observaciones</span>
                                </div>
                                <div class='job-item job-observations'>
                                    {$result->observaciones}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }

            $html .= '

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';

        } else {
            $results = $wpdb->get_results('SELECT nombre, pais, cargo_requerido FROM ofertas_laborales LIMIT 3');

            foreach ($results as $result) {
                $html .= "
                <style>
                    .job-item{
                        padding: 5px 0px;
                        text-align: center;
                        font-weight: 400;
                        font-family: 'Poppins', sans-serif;
                        font-size: 14px;
                    }
                    .job-item-title{
                        font-weight: 600;
                    }
                </style>
                <div class='item-columns'>
                    <div class='team-block team-v2 '>
                        <div class='team-image'>
                            <a href='#'><img
                                    width='450' height='500'
                                    src='http://embajadores.projectsw2t.net/wp-content/uploads/2020/12/logo-universidad-yacambu.png'
                                    class='attachment-post-thumbnail size-post-thumbnail wp-post-image' alt=''
                                    loading='lazy'></a>
                        </div>
                        <div class='team-content'>
                            <div class='team-content-inner' style='padding:60px 0px 50px;'>
                                <div class='team-job' style='font-size: 18px; padding-bottom: 5px;'>
                                    {$result->cargo_requerido}
                                </div>
                                <div class='team-name' style='padding-bottom: 5px !important;'>
                                        {$result->nombre}
                                </div>
                                <div class='job-item-title'>
                                    <span>País</span>
                                </div>
                                <div class='job-item job-country'>{$result->pais}</div>
                                <div class='job-item-title'>
                                    <span>Debe acceder para ver la información completa</span>
                                </div>
                                <div class='job-item job-observations'>
                                    <button onclick=\"window.location.replace('/acceso')\">Acceder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }

            $html .= '

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        return $html;
    }

}
