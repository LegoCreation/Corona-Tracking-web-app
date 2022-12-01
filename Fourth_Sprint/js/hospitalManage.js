function change_status(e, status) {
    var span = e.target.closest('span.close');
    var hospitalId = span.getAttribute('data-hospital-id');

    var data = new FormData()
    data.append('hospitalId', hospitalId);
    data.append('status', status);

    return fetch('../ajax.php', {
        method: 'POST',
        body: data,
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        console.log(response);
        span.parentElement.removeChild(span);
    });
}

function accept(e) {
    change_status(e, 'accepted');
}

function reject(e) {
    change_status(e, 'rejected');
}

