function change_status(e, status) {
    var span = e.target.closest('span.close');

    var visitorId = span.getAttribute('data-visitor-id');

    var data = new FormData()
    data.append('visitorId', visitorId);
    data.append('status', status);

    return fetch('../markVisitor.php', {
        method: 'POST',
        body: data,
    }).then(function (response) {
        return response.json();
    }).then(function (response) {
        var statusNode = span.querySelector('b')
        if (statusNode) {
            statusNode.innerText = status
        }
    });
}

function accept(e) {
    change_status(e, 'infected');
}

function reject(e) {
    change_status(e, 'uninfected');
}
