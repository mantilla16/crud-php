/**
 * Las funciones openModalUser, openModalPlan y openModalSus se utilizan para abrir modales
 * y configurar sus campos según la acción (crear o editar).
 * Cada uno recibe los parametros necesarios para llenar los campos del formulario. 
 */

function openModalUser(action, id = null, nombre = '', correo = '') {
    const modal = document.getElementById('crud-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('crud-form');
    // Configura el modal según sea edición o creación
    if (action === 'edit') {
        title.textContent = 'Editar Usuario';
        document.getElementById('form-action').value = 'editar';
        document.getElementById('record-id').value = id;
        document.getElementById('name').value = nombre;
        document.getElementById('email').value = correo;
    } else {
        title.textContent = 'Nuevo Usuario';
        document.getElementById('form-action').value = 'crear';
        document.getElementById('record-id').value = '';
        form.reset();
    }
    
    modal.style.display = 'flex';
}

function openModalPlan(action, id = null, nombre = '', precio = '', duracion = '', descripcion = '') {
    const modal = document.getElementById('crud-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('crud-form');
    
    if (action === 'edit') {
        title.textContent = 'Editar Plan';
        document.getElementById('form-action').value = 'editar';
        document.getElementById('record-id').value = id;
        document.getElementById('name').value = nombre;
        document.getElementById('precio').value = precio;
        document.getElementById('duracion').value = duracion;
        document.getElementById('descripcion').value = descripcion;

    } else {
        title.textContent = 'Nuevo Plan';
        document.getElementById('form-action').value = 'crear';
        document.getElementById('record-id').value = '';
        form.reset();
    }
    
    modal.style.display = 'flex';
}

function openModalSus(action, id = '', usuario = '', plan = '', inicio = '', fin = '', estado = '') {
    const modal = document.getElementById('crud-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('crud-form');
    
    if (action === 'edit') {
        title.textContent = 'Editar Suscripcion';
        document.getElementById('form-action').value = 'editar';
        document.getElementById('record-id').value = id;
        document.getElementById("usuario_id").value = usuario;
        document.getElementById("plan_id").value = plan;
        document.getElementById("fecha_inicio").value = inicio;
        document.getElementById("fecha_fin").value = fin;
        document.getElementById("estado").value = estado;

    } else {
        title.textContent = 'Nueva Suscripcion';
        document.getElementById('form-action').value = 'crear';
        document.getElementById('record-id').value = '';
        form.reset();
    }
    
    modal.style.display = 'flex';
}


/**
 * Calcula automáticamente la fecha de fin cuando cambia:
 * - El plan seleccionado
 * - La fecha de inicio
 * 
 * Usa el atributo data-duracion del option seleccionado
 * Se envolvio todo en un addEventListener para evitar que se ejecute esta parte en otra pagina diferente
 * donde se encuentran los campos de fecha_inicio y fecha_fin
 */
document.addEventListener('DOMContentLoaded', function () {
    const planSelect = document.getElementById('plan_id');
    const fechaInicioInput = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');

    if (planSelect && fechaInicioInput && fechaFin) {
        planSelect.addEventListener('change', function () {
            // Calcula fecha fin = fecha inicio + duración del plan
            if (planSelect.value && fechaInicioInput.value) {
                const duracion = parseInt(planSelect.options[planSelect.selectedIndex].getAttribute('data-duracion'));
                const inicioDate = new Date(fechaInicioInput.value);
                inicioDate.setDate(inicioDate.getDate() + duracion);
                fechaFin.value = inicioDate.toISOString().split('T')[0];
            }
        });

        fechaInicioInput.addEventListener('change', function () {
            if (planSelect.value) {
                planSelect.dispatchEvent(new Event('change'));
            }
        });
    }
});


/**
 * Esta funcion es para cerrar el modal principal.
 */
function closeModal() {
    document.getElementById('crud-modal').style.display = 'none';
}
/**
 * Muestra el modal de confirmación para eliminar un registro.
 * Se le pasa el id del registro a eliminar.
 * @param {number} id - ID del registro a eliminar 
 */
function confirmDelete(id) {
    document.getElementById('delete-id').value = id;
    document.getElementById('confirm-modal').style.display = 'flex';
}
/***
 * Esta funcion se ejecuta cuando se confirma la eliminacion de un registro.
 * Se envia el formulario de confirmacion.
 */
function closeConfirmModal() {
    document.getElementById('confirm-modal').style.display = 'none';
}

// Cerrar modales al hacer clic fuera del contenido
window.onclick = function(event) {
    const modals = ['crud-modal', 'confirm-modal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}