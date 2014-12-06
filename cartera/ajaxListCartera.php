<?php
	require_once '../conexion.php';

	$conexion = conectar();

	$sql = "
        select
          a.id_cartera,
          a.nom_cartera,
          DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y') as fecha,
          datediff(a.fecha_entrega, a.fecha_inicio) as dias,
          a.id_proceso,
          a.recabar_doc_mls,
          a.firma_aviso_privacidad,
          a.nuevo_contrato,
          a.estatus,
          a.fecha_entrega,
          a.promesa,
          a.fechaEsperada,
          a.fechaCierre,
          a.coment_promesa,
          b.id_cat,
          c.nom_cat,
          concat(d.nombre, ' ', d.ap_paterno) as nombre,
          (
           SELECT
            concat(dd.nombre,' ',dd.ap_paterno,' ',dd.ap_materno)
           FROM
            proceso_cartera aa,
            usuario dd
           WHERE
            aa.id_proceso = a.id_proceso
           AND
            aa.resp = dd.id_user
          ) as creador
        from
          proceso_cartera a,
          procesos b,
          categoria c,
          usuario d
        where
          not exists (select bb.estatus from proceso_cartera bb where a.id_cartera=bb.id_cartera and bb.estatus >= 1 )
        and
          a.id_proceso = b.id_proceso
      	and
          b.id_cat = c.id_cat
      	and
          c.id_cat = d.id_cat
        order by a.fecha_entrega
    ";
	$rows = array();

	$resultado = $conexion->query($sql);

	while ($row = $resultado->fetch_array()) {

		$rows['data'][]=$row;

	}

	echo json_encode($rows);
?>