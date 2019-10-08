var yandexGeoJson = {};

function setYandexGeoJson(object) {
    yandexGeoJson = object;
}

function addFeature(name, description, coordinates) {
    yandexGeoJson.features.push({
        "type":"Feature",
        "id": 0,
        "geometry": {
            "coordinates": coordinates,
            "type":"Point"
        },
        "properties": {
            "description": description,
            "iconCaption": name,
            "marker-color": "#ff931e"
        }
    })
}

function createFile() {
    $.ajax({
        method: "POST",
        url: "/bankruptcy/create-file-for-yandex-map",
        data: "json=" + JSON.stringify(yandexGeoJson),
        success: function (response) {
            console.log(response);
        }
    });
}