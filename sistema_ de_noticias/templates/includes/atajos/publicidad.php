<?php

                    // Consulta para obtener hasta 7 publicidades aleatorias
                    $publi = new publicidadModel();
                    $data = $publi->publicidadli();
                    $countpu = is_array($data)? count($data) : 0;
                    if ($countpu > 0) {
                        // Mostrar las publicidades
                        foreach ($data as $key) {
                            echo '<img class="img-fluid rounded-2 my-2 ms-1" src="' . UPLOADS . $key["img_destacada"] . '" alt="Publicidad">';
                        }
                    }
                    else{
                        echo 'No hay datos disponibles.';
                    }
?>