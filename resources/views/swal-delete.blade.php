<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('information') == 'delete')
	<script>
		Swal.fire(
			'Deleted',
			'Register deleted successfully.',
			'success'
		)
	</script>
@endif

<script>
	$('.swal-delete').submit(function(e) {
		e.preventDefault();
		Swal.fire({
			title: 'Delete?',
			text : "This action is irreversible.",
			icon : 'warning',
			showCancelButton  : true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor : '#d33',
			confirmButtonText : 'Delete',
			cancelButtonText  : 'Cancel'
		}).then((result) => {
			if (result.value) { this.submit(); }
		})
	});
</script>