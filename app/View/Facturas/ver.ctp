<style type="text/css">
	.leftTd{
		text-align: left;
	}
	.dataTables_scroll{
		width: 100% !important;
	}
	table.table {
	clear: both;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
	max-width: none !important;
	border-collapse: separate;
	}
	table.dataTable,
	table.dataTable td,
	table.dataTable th {
	cursor: pointer;
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	}
	.ColVis_collection li{
		width: 20%;
	}
	.ColVis_collection li label{
		float: left;
		padding: 0px 20px;
	}
	.dataTables_wrapper {
		margin-left: 0px;
	}
	.btnTable {
		padding: 4px 10px;
		background: rgb(205, 226, 244);
		color: rgb(65, 77, 94);
		border-radius: 5px;
		font-weight: bold;
	}
</style>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
		<div><h3><center>DETALLE FACTURA</center></h3></div>

		<p><strong>Nro Factura: </strong><?php echo $factura['Factura']['relacionfactura_id']; ?></p>
		<p><strong>Nro Relacion: </strong><?php echo $factura['Factura']['id']; ?></p>
		<p><strong>Cliente: </strong><?php echo $factura['Factura']['cliente_nom']; ?></p>
		<p><strong>Cedula: </strong><?php echo $factura['Factura']['cliente_cc']; ?></p>
		<p><strong>Direccion: </strong><?php echo $factura['Factura']['cliente_dir']; ?></p>
		<p><strong>Telefono: </strong><?php echo $factura['Factura']['cliente_tel']; ?></p>
		<p><strong>Fecha Facturada: </strong><?php echo $factura['Factura']['fecha']; ?></p>
		<p><strong>Fecha Vencimiento: </strong><?php echo $factura['Factura']['vence']; ?></p>
		<p><strong>Valor Factura:   </strong><?php echo $factura['Factura']['valor']; ?></p>
		<p><strong>Estado:    </strong><?php echo $factura['Factura']['estado']; ?></p>


			<!--	/*
				(
		    [Factura] => Array
		        (
		            [id] => 15
		            [numero] => 115058
		            [cliente_nom] => MANDAR Y SERVIR S.A.
		            [cliente_cc] => 811023661
		            [cliente_dir] => CARRERA 46 # 42 - 79
		            [cliente_tel] => 4446033
		            [fecha] => 2016-03-16 11:03:39
		            [vence] => 2016-03-16 00:00:00
		            [relacionfactura_id] => 3
		            [cliente] => 2
		            [resolucion] => 110000513931 de 2012/12/21
		            [valor] => 2999.9700000000003
		            [estado] => 1
		            [usuario] => 1
		        )

		    [Relacionfactura] => Array
		        (
		            [id] => 3
		            [cliente_id] => 2
		            [dni] => 3
		            [fecha] => 2016-03-16 00:00:00
		            [usuario] => 1
		            [estado] => 1
		        )

		)
		*/ -->