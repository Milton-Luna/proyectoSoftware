let editIndex = null;
let selectedDay = 'lunes';

// Agregar evento
function addEvent() {
    const eventTitle = document.getElementById('event-title').value;
    const eventDescription = document.getElementById('event-description').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    const repeatType = document.getElementById('event-repeat').value;

    if (!eventTitle || !eventDescription || !startDate || !endDate) {
        showNotification("Todos los campos son obligatorios.", "error");
        return;
    }

    if (new Date(startDate) > new Date(endDate)) {
        showNotification("La fecha de inicio no puede ser posterior a la fecha de fin.", "error");
        return;
    }

    let events = JSON.parse(localStorage.getItem('events')) || [];

    if (editIndex !== null) {
        events[editIndex] = { title: eventTitle, description: eventDescription, startDate, endDate, repeatType };
        editIndex = null;
    } else {
        events.push({ title: eventTitle, description: eventDescription, startDate, endDate, repeatType });
    }

    localStorage.setItem('events', JSON.stringify(events));
    document.getElementById('eventForm').reset();
    showNotification("Evento agregado exitosamente.", "success");
    loadEvents();
}

// Cargar eventos
function loadEvents() {
    const eventList = document.getElementById('eventList');
    eventList.innerHTML = '';
    let events = JSON.parse(localStorage.getItem('events')) || [];
    const filteredEvents = events.filter(event => {
        const eventDate = new Date(event.startDate);
        const eventDay = eventDate.toLocaleDateString('es-ES', { weekday: 'long' });
        return eventDay.toLowerCase() === selectedDay;
    });

    filteredEvents.forEach((event, index) => {
        let row = `<tr>
            <td>${event.title}</td>
            <td>${event.startDate}</td>
            <td>${event.endDate}</td>
            <td>${event.description}</td>
            <td>
                <button class="btn" onclick="editEvent(${index})">Modificar</button>
                <button class="btn" onclick="deleteEvent(${index})">Eliminar</button>
            </td>
        </tr>`;
        eventList.innerHTML += row;
    });
}

// Filtrar eventos por día
function filterEventsByDay(day) {
    selectedDay = day;
    document.getElementById('selectedDay').textContent = capitalizeFirstLetter(day);
    updateSidebarButtons(day);
    loadEvents();
}

// Notificación
function showNotification(message, type) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.color = type === 'success' ? 'green' : 'red';
    notification.style.display = 'block';
    setTimeout(() => notification.style.display = 'none', 3000);
}

// Editar evento
function editEvent(index) {
    let events = JSON.parse(localStorage.getItem('events')) || [];
    const event = events[index];

    document.getElementById('event-title').value = event.title;
    document.getElementById('event-description').value = event.description;
    document.getElementById('start-date').value = event.startDate;
    document.getElementById('end-date').value = event.endDate;
    document.getElementById('event-repeat').value = event.repeatType;
    editIndex = index;
}

// Eliminar evento
function deleteEvent(index) {
    let events = JSON.parse(localStorage.getItem('events')) || [];
    events.splice(index, 1);
    localStorage.setItem('events', JSON.stringify(events));
    showNotification("Evento eliminado exitosamente.", "success");
    loadEvents();
}

// Actualizar botones de la barra lateral
function updateSidebarButtons(day) {
    document.querySelectorAll('.sidebar button').forEach(button => button.classList.remove('active'));
    document.getElementById(`btn-${day}`).classList.add('active');
}

// Función para capitalizar la primera letra
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Al cargar la página
window.onload = function() {
    filterEventsByDay('lunes');
};
