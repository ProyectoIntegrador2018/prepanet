$(document).ready(function () {
    $(".delete-alumno").click(function () {
        $('#delete-alumno-modal form').attr('action', '/alumnos/delete/' + $(this).data('alumno-id'));
    });

})
