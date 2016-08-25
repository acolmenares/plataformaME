<?php
incluir_script($rutaJs);
construir_barra_acciones($Menu);
?>
<div class="container-fluid">
    <?php
    construir_encabezado($Titulo, $Referencia);
    ?>

    <div class="table-responsive">
        <table class="table  table-bordered table-hover table-condensed"><!-- table-striped -->
            <tr class="active">
                <th rowspan="2"></th>
                <th rowspan="2">C&oacute;digo</th>
                <th rowspan="2">Nombre</th>
                <?php
                $numCeldas = 0;
                for ($s = intval($objCasilla->mes_inicial); $s < intval($objCasilla->mes_inicial) + $objCasilla->numero_meses; $s++) {
                    $indiceSemana = $s;
                    if ($s <= 9) {
                        $indiceSemana = "0" . $s;
                    }
                    ?>
                    <th colspan="<?php print $objCasilla->arraySemanasxMes[$indiceSemana]; ?>"><?php print $objCasilla->arrayMeses[$indiceSemana]; ?></th>
                    <?php
                    $numCeldas = $numCeldas + $objCasilla->arraySemanasxMes[$indiceSemana];
                }
                ?>

                <th rowspan="2">Responsable</th>
                <th rowspan="2">Observaciones</th>

            </tr>
            <tr class="active">
                <?php
                for ($m = intval($objCasilla->mes_inicial); $m < intval($objCasilla->mes_inicial) + $objCasilla->numero_meses; $m++) {
                    $indiceMes = $m;
                    if ($m <= 9) {
                        $indiceMes = "0" . $m;
                    }
                    for ($s = 1; $s <= $objCasilla->arraySemanasxMes[$indiceMes]; $s++) {
                        ?>
                        <th><?php print $s ?></th>
                        <?php
                    }
                }
                ?>
            </tr>
            <?php
            $temp = "";
            $rowspan = $numCeldas + 5;
            foreach ($objMacroactividad->arrayMacroactividad as $macroactividad) {
                $indice = $macroactividad->idmacroactividad;
                if ($temp != $macroactividad->idobjetivo) {
                    ?>
                    <tr>
                        <td colspan="<?php print $rowspan; ?>" class="warning"><?php print $macroactividad->nombre_objetivo; ?></td>      
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td>
                        <input type="radio" name="radio_registro" id="radio_registro" value="<?php print $macroactividad->idmacroactividad; ?>">
                    </td>
                    <td><?php print $macroactividad->codigo_macroactividad; ?></td>    
                    <td><?php print $macroactividad->nombre_macroactividad; ?></td>
                    <?php for ($s = 1; $s <= $numCeldas; $s++) { ?>
                        <th><input type="checkbox" id="semana[<?php print $macroactividad->idmacroactividad; ?>]" name="semana[<?php print $macroactividad->idmacroactividad; ?>]" value="<?php print $s; ?>"></th>
                    <?php }
                    ?>
                    <td><?php print $arregloPersonas[$indice]; ?></td>
                    <td><?php print $macroactividad->descripcion_macroactividad; ?></td>
                </tr>

                <?php
                $temp = $macroactividad->idobjetivo;
            }
            ?>
            <input type="hidden" name="miparametro" id="miparametro" value="<?php print $objModulo->miparametro; ?>">
            <input type="hidden" name="mimodulo" id="mimodulo" value="<?php print $objModulo->mimodulo; ?>">
            <input type="hidden" name="moduloantecesor" id="moduloantecesor" value="<?php print $objModulo->moduloantecesor; ?>">

        </table>
    </div>
</div>