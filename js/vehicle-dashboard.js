document.addEventListener('DOMContentLoaded', function () {
    // Initialize sorting for Service History Table
    const serviceHistoryTable = document.getElementById('serviceHistoryTable');
    const serviceHistoryHeaders = serviceHistoryTable.querySelectorAll('th[data-sort]');
    addSorting(serviceHistoryTable, serviceHistoryHeaders);

    // Initialize sorting for Active Appointments Table
    const activeAppointmentsTable = document.getElementById('activeAppointmentsTable');
    const activeAppointmentsHeaders = activeAppointmentsTable.querySelectorAll('th[data-sort]');
    addSorting(activeAppointmentsTable, activeAppointmentsHeaders);
});

function addSorting(table, headers) {
    headers.forEach(header => {
        header.addEventListener('click', () => {
            const sortKey = header.getAttribute('data-sort');
            const isAscending = header.classList.contains('asc');
            sortTable(table, sortKey, isAscending);
            header.classList.toggle('asc', !isAscending);
            updateSortIcons(header, isAscending);
        });
    });
}

function sortTable(table, sortKey, isAscending) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort((a, b) => {
        const aValue = a.querySelector(`td:nth-child(${getIndex(sortKey)})`).textContent;
        const bValue = b.querySelector(`td:nth-child(${getIndex(sortKey)})`).textContent;

        if (sortKey === 'date') {
            // Convert dates to timestamps for comparison
            return isAscending
                ? new Date(aValue) - new Date(bValue)
                : new Date(bValue) - new Date(aValue);
        } else {
            // Sort alphabetically
            return isAscending
                ? aValue.localeCompare(bValue)
                : bValue.localeCompare(aValue);
        }
    });

    // Clear and re-append sorted rows
    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}

function getIndex(sortKey) {
    switch (sortKey) {
        case 'plateNumber': return 1;
        case 'date': return 2;
        case 'status': return 3;
        case 'services': return 4;
        default: return 0;
    }
}

function updateSortIcons(header, isAscending) {
    const headers = header.parentElement.querySelectorAll('th[data-sort]');
    headers.forEach(h => {
        h.querySelector('i').className = 'fas fa-sort';
    });

    const icon = header.querySelector('i');
    icon.className = isAscending ? 'fas fa-sort-down' : 'fas fa-sort-up';
}

function cancelAppointment(appointmentId) {
    if (confirm('Are you sure you want to cancel this appointment?')) {
        fetch('cancel_appointment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ appointmentId: appointmentId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Appointment canceled successfully.');
                location.reload(); // Refresh the page
            } else {
                alert('Failed to cancel appointment.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while canceling the appointment.');
        });
    }
}