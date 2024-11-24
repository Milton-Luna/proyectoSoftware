const API_URL = 'http://localhost:3000/api/eventos';

// Cargar eventos al cargar la página
document.addEventListener('DOMContentLoaded', async () => {
    const response = await fetch(API_URL);
    const events = await response.json();
    const eventsTable = document.querySelector('#events-table tbody');
    
    events.forEach(event => {
        const row = `
            <tr>
                <td>${event.title}</td>
                <td>${new Date(event.startDate).toLocaleString()}</td>
                <td>${new Date(event.endDate).toLocaleString()}</td>
                <td>${event.description}</td>
                <td><button onclick="deleteEvent(${event.id})">Eliminar</button></td>
            </tr>
        `;
        eventsTable.innerHTML += row;
    });
});
//allsan


// Agregar nuevo evento
document.querySelector('#event-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const title = document.querySelector('#title').value;
    const startDate = document.querySelector('#startDate').value;
    const endDate = document.querySelector('#endDate').value;
    const description = document.querySelector('#description').value;

    const response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title, startDate, endDate, description })
    });

    if (response.ok) {
        window.location.reload(); // Recargar la página para ver los nuevos eventos
    }

});

// Eliminar evento
async function deleteEvent(id) {
    const response = await fetch(`${API_URL}/${id}`, { method: 'DELETE' });
    if (response.ok) {
        window.location.reload(); // Recargar la página después de eliminar
    }
}
