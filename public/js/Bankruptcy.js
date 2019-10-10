$('body').on('submit', '#excel-form', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    console.log(formData);

    $.ajax({
        type: 'POST',
        url: this.action,
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log('success');
        },
        error: function (response) {
            console.log('error');
        }
    })
});

ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map('map', {
            center: [55.76, 37.64],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            clusterize: true,
            gridSize: 32,
            clusterDisableClickZoom: true
        });

    $.getJSON('../../test.geojson')
        .done(function (geoJson) {
            var yandexService = new YandexConstructorService(geoJson);
            yandexService.addFeature('name', 'description', ['00001', '000002']);
            // createFile();
        });
}