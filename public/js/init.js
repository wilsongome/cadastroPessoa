$(document).ready(function(){

    $('.btn-delete').click(function(event){
        if(!confirm("Do you want to remove it?")){
            event.preventDefault();
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(".cpf").mask("999.999.999-99");
    $(".data").mask("99/99/9999");
});