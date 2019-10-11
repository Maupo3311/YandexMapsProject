$(document).ready(function () {
    loadExcelList();
    // ymaps.ready(init);
});

$('body').on('submit', '#excel-form', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

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
            loadExcelList();
        },
        error: function (response) {
            console.log('error');
            loadExcelList();
        }
    })
});

$('body').on('submit', '#read-excel-form', function (e) {
    e.preventDefault();

    $.ajax({
        type: 'GET',
        url: this.action,
        data: $(this).serialize(),
        contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
        success: function (response) {
            var excelCadNumberBlock = document.getElementById('excel-cad-numbers');
            excelCadNumberBlock.innerHTML = response.responseText;
        },
        error: function (response) {
            var excelCadNumberBlock = document.getElementById('excel-cad-numbers');
            excelCadNumberBlock.innerHTML = response.responseText;
        }
    })
});

function loadExcelList() {
    $.ajax({
        type: 'GET',
        url: "http://127.0.0.1:8000/excel/get-list",
        success: function (response) {
            var rightWindow = document.getElementById('left-window-content');
            rightWindow.innerHTML = response;
        }
    })
}

function loadExcelForm() {
    $.ajax({
        type: 'GET',
        url: "http://127.0.0.1:8000/excel/get-form",
        success: function (response) {
            var rightWindow = document.getElementById('left-window-content');
            rightWindow.innerHTML = response;
        }
    })
}

function selectFile(row) {
    var excelFormFilename = document.getElementById('read_excel_filename');
    excelFormFilename.value = row.innerHTML;
}

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