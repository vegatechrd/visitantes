<?php
	$sesionU = session();
?>
	<footer class="main-footer">
		<div class="float-right d-none d-sm-block">
			<b>Version [<?php echo $sesionU->version; ?>] </b>
		</div>
		<strong>APPS INESPRE &copy; <?php echo date('Y'); ?></strong>
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
	
	<!-- Obtener permisos -->
	<script>

	<?php if(!isset($privs['C'])) { ?>var permisosC = "N";<?php } else{ ?> var permisosC = "<?= $privs['C'] ?>"<?php } ?>; <?php if(!isset($privs['U'])) { ?> var permisosU = "N"; <?php } else{ ?> var permisosU = "<?= $privs['U'] ?>"<?php } ?>;  <?php if(!isset($privs['D'])) { ?>var permisosD = "N";<?php } else{ ?> var permisosD = "<?= $privs['D'] ?>"<?php } ?>; 

	$(".data-table").dataTable({
      "language": {
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas", 
      "infoFiltered": "",
      "emptyTable": "No hay datos registrados para mostrar en la tabla.",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
    }
    },
     "paging": true,
     "ordering": false,
	 "responsive": true
	 
	});

	var oTable = $('.data-table').DataTable();

  	$("#txtBuscar").keyup(function() {
  	$('.data-table').dataTable().fnFilter(this.value);
    });    
 
	$('#selectEntries').val(oTable.page.len());
	$('#selectEntries').change( function() { 
	oTable.page.len($(this).val() ).draw();
	});


	jQuery(".dataTables_info").appendTo(jQuery("#numbers_numbers"));
	jQuery(".dataTables_paginate").appendTo(jQuery("#pagination_pagination"));

</script>
	
</body>

</html>