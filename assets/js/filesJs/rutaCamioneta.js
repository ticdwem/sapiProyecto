$(function(){
    $(document).on('click','button[type="button"]',function(event){
        let idCamioneta = this.id;
        let chofer = this.dataset.get;

        let camioneta = expRegular('dir',idCamioneta);
        let chof = expRegular('phone',chofer);

        if(camioneta != 0 || chof != 0){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
              })
        }


    })
});