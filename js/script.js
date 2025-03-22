$(document).ready(function () {
    loadUsers();

    $("#search").on("input", function () {
        loadUsers(1, $(this).val());  // Reinicia la paginación al buscar
    });
});

function loadUsers(page = 1, search = '') {
    $.getJSON(`api/api.php?page=${page}&search=${search}`, function (data) {
        let html = "";
        data.users.forEach(user => {
            html += `<tr>
                <td>${user.dni}</td>
                <td>${user.full_name}</td>
                <td>${user.birthday}</td>
                <td>${user.phone}</td>
                <td>${user.email}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editUser(${user.id})">Editar</button>
                </td>
            </tr>`;
        });

        $("#usuarios").html(html);

        generatePagination(data.totalPages, data.currentPage);
    });
}

function generatePagination(totalPages, currentPage) {
    let paginationHtml = '';

    // Botón anterior
    if (currentPage > 1) {
        paginationHtml += `<li class="page-item">
            <a class="page-link" href="#" onclick="loadUsers(${currentPage - 1})">&laquo; Anterior</a>
        </li>`;
    }

    // Botones de páginas
    for (let i = 1; i <= totalPages; i++) {
        let activeClass = (i === currentPage) ? 'active' : '';
        paginationHtml += `<li class="page-item ${activeClass}">
            <a class="page-link" href="#" onclick="loadUsers(${i})">${i}</a>
        </li>`;
    }

    // Botón siguiente
    if (currentPage < totalPages) {
        paginationHtml += `<li class="page-item">
            <a class="page-link" href="#" onclick="loadUsers(${currentPage + 1})">Siguiente &raquo;</a>
        </li>`;
    }

    $("#pagination").html(paginationHtml);
}

function newUser() {
    $("#modalTitle").text("Nuevo Usuario");
    $("#userId").val("");
    $("#dni, #name, #birthday, #phone, #email").val("");
    $("#userModal").modal("show");
}

function editUser(id) {
    $.getJSON(`api/api.php?id=${id}`, function (data) {
        $("#modalTitle").text("Editar Usuario");
        $("#userId").val(data.id);
        $("#dni").val(data.dni);
        $("#name").val(data.full_name);
        $("#birthday").val(data.birthday);
        $("#phone").val(data.phone);
        $("#email").val(data.email);
        $("#userModal").modal("show");
    });
}

function saveUser() {
    let id = $("#userId").val();
    let data = {
        dni: $("#dni").val(),
        full_name: $("#name").val(),
        birthday: $("#birthday").val(),
        phone: $("#phone").val(),
        email: $("#email").val()
    };

    error = validateData(data);
    if (error.length > 0) {
        alert(error.join("\n"));
        return;
    }

    $.ajax({
        url: "api/api.php" + (id ? `?id=${id}` : ""),
        type: id ? "PUT" : "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        success: function () {
            $("#userModal").modal("hide");
            loadUsers();
        }
    });
}

function validateData(data) {
    let errors = [];

    if (!data.dni) {
        errors.push("El DNI es obligatorio");
    } else if (!/^\d{8}[A-Z]$/.test(data.dni)) {
        errors.push("El DNI no es válido");
    }

    if (!data.full_name) {
        errors.push("El nombre es obligatorio");
    } else if (!/^[A-Z][a-z]+( [A-Z][a-z]+)+$/.test(data.full_name)) {
        errors.push("El nombre no es válido");
    }

    if (!data.birthday) {
        errors.push("La fecha de nacimiento es obligatoria");
    } else if (!/^\d{4}-\d{2}-\d{2}$/.test(data.birthday)) {
        errors.push("La fecha de nacimiento no es válida");
    }

    if (!data.phone) {
        errors.push("El teléfono es obligatorio");
    } else if (!/^\d{9}$/.test(data.phone)) {
        errors.push("El teléfono no es válido");
    }

    if (!data.email) {
        errors.push("El email es obligatorio");
    } else if (!/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(data.email)) {
        errors.push("El email no es válido");
    }

    return errors;
}
