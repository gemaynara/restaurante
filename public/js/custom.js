function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#img").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


$(".delete").on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('remote');
    var id = $(this).data("id");
    Swal.fire({
        icon: "question",
        title: "Você tem certeza?",
        text: `Que deseja excluir esse registro?`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: `Não`,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'DELETE',
                success: function (response) {
                    Swal.fire(
                        "Sucesso!",
                        'O registro foi excluído com sucesso!',
                        'success'
                    )
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function (err){
                    console.log(err)
                    Swal.fire(
                        "Oops!",
                        'Ocorreu um erro!'+ err,
                        'error'
                    )
                }
            });
        }
    })
});

