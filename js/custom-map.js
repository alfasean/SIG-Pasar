$(document).ready(function() {
    var map = L.map('map').setView([1.4564212, 124.8229092], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    $.ajax({
        url: 'map.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var marker = L.marker([data[i].lat, data[i].lng]).addTo(map);
                    marker.bindPopup(data[i].name + '<br><button class="detail-btn" data-id="' + data[i].id_pasar + '">Detail</button>');
                }

                $('#map').on('click', '.detail-btn', function() {
                    var pasarId = $(this).data('id');
                    showDetail(pasarId);
                });
            }
        },
        error: function(error) {
            console.log('Error loading markers:', error);
        }
    });

    function showDetail(pasarId) {
        window.location.href = 'detail.php?id_pasar=' + pasarId;
    }
});
