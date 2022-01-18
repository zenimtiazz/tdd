const bookings = document.getElementById('bookings');
if(bookings) {

    bookings.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-booking') {
            if (confirm('Are you sure')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/booking/delete/${id}`,
                    {method: 'DELETE'})
                    .then(res => window.location.reload());
            }
        }
    });
}

