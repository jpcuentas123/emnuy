<?php

/**
 *
 * This class handles emprendimientos storage
 *
 */
class EmprendimientosStore
{

    /**
     * This method handles storage to db
     * @param object $wpdb
     * @param array $postedData
     * @param array $uploadedFiles
     * @return boolean
     *
     */
    public static function store($wpdb, $posted_data, $uploaded_files)
    {

        $store_array = [];

        try {

            $store_array = array_merge($store_array, [
                "nombre" => $posted_data["nombre"],
                "correo" => $posted_data["correo"],
                "telefono" => $posted_data["telefono"],
                "pais" => $posted_data["pais"][0],
                "comentarios" => $posted_data["comentarios"],
                "pagina_web" => $posted_data["pagina_web"],
                "autorizado_a_compartir" => ($posted_data["autorizado_a_compartir"][0] == "Si") ? true : false,
            ]);

            if (null !== $uploaded_files["logo"]) {

                $path = $uploaded_files["logo"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $store_array = array_merge($store_array, ["logo" => $base64]);
            }
            if (null !== $uploaded_files["foto_producto_servicio"]) {
                $path = $uploaded_files["foto_producto_servicio"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $store_array = array_merge($store_array, ["foto_producto_servicio" => $base64]);
            }

            return $wpdb->insert('emprendimientos', $store_array);

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
            '<div class="elementor-element elementor-element-e9a3ead elementor-widget elementor-widget-gva-teams" data-id="e9a3ead"
                data-element_type="widget" data-widget_type="gva-teams.default">
                            <div class="elementor-widget-container">
                                <div class="gva-element-gva-teams gva-element">
                                    <div class="gva-teams-grid clearfix grid-jre2">
                                        <div class="gva-content-items">
                                            <div class="lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-1">';

        if ($isMember) {
            $results = $wpdb->get_results("SELECT nombre, correo, telefono, pais, pagina_web, comentarios, logo FROM emprendimientos WHERE autorizado_a_compartir = 1");
            foreach ($results as $result) {
                $logo = $result->logo !== null ? $result->logo : "http://embajadores.projectsw2t.net/wp-content/uploads/2020/12/logo-universidad-yacambu.png";

                $html .= "
                <style>
                    .job-item{
                        padding: 5px 0px;
                        text-align: center;
                        font-weight: 400;
                        font-family: 'Poppins', sans-serif;
                        font-size: 14px;
                        overflow-wrap: anywhere;
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
                                    src='{$logo}'
                                    class='attachment-post-thumbnail size-post-thumbnail wp-post-image' alt=''
                                    loading='lazy'></a>
                        </div>
                        <div class='team-content'>
                            <div class='team-content-inner' style='padding:60px 0px 50px;'>
                                <div class='team-job' style='font-size: 18px; padding-bottom: 5px;'>
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
                                    <span>Página web</span>
                                </div>
                                <div class='job-item job-specification'>{$result->pagina_web}</div>
                                <div class='job-item-title'>
                                    <span>Observaciones</span>
                                </div>
                                <div class='job-item job-observations'>
                                    {$result->comentarios}
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
            $results = $wpdb->get_results("SELECT nombre, pais, pagina_web FROM emprendimientos WHERE autorizado_a_compartir = 1 LIMIT 3");

            foreach ($results as $result) {

                $logo = $result->logo !== null ? $result->logo : "http://embajadores.projectsw2t.net/wp-content/uploads/2020/12/logo-universidad-yacambu.png";

                $html .= "
                <style>
                    .job-item{
                        padding: 5px 0px;
                        text-align: center;
                        font-weight: 400;
                        font-family: 'Poppins', sans-serif;
                        font-size: 14px;
                        overflow-wrap: anywhere;
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
                                    src='{$logo}'
                                    class='attachment-post-thumbnail size-post-thumbnail wp-post-image' alt=''
                                    loading='lazy'></a>
                        </div>
                        <div class='team-content'>
                            <div class='team-content-inner' style='padding:60px 0px 50px;'>
                                <div class='team-job' style='font-size: 18px; padding-bottom: 5px;'>
                                        {$result->nombre}
                                </div>
                                <div class='job-item-title'>
                                    <span>País</span>
                                </div>
                                <div class='job-item job-country'>{$result->pais}</div>
                                <div class='job-item-title'>
                                    <span>Debe acceder para ver la información completa</span>
                                </div>
                                <div class='job-item job-country'><button onclick=\"window.location.replace('/acceso')\">Acceder</button></div>
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
