class YandexConstructorService {
    constructor(yandexGeoJson = {}) {
        if (yandexGeoJson === {}) {
            this.yandexGeoJson = {
                "type": "FeatureCollection",
                "metadata": {
                    "name": "Test",
                    "creator": "Yandex Map Constructor"
                },
                "features": []
            }
        } else {
            this.yandexGeoJson = yandexGeoJson;
        }
    }

    addFeature(name, description, coordinates) {
        this.yandexGeoJson.features.push({
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

    createFile() {
        $.ajax({
            method: "POST",
            url: "/bankruptcy/create-file-for-yandex-map",
            data: "json=" + JSON.stringify(yandexGeoJson),
            success: function (response) {
                console.log(response);
            }
        });
    }
}