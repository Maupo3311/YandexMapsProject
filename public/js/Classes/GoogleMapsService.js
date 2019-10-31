class GoogleMapsService {

    /***************************************************************************
     *                                Strings
     **************************************************************************/
    getInfoButtonId = 'get_info_button';

    constructor(cadNumbers = []) {
        this.cadNumbers = cadNumbers;
        this.initHandlers();
    }

    /***************************************************************************
     *                             Init Handlers
     **************************************************************************/
    initHandlers = () => {

        $(document).on('click', '#' + this.getInfoButtonId, e => {
            var query = '?cadNumbers=' + JSON.stringify(this.cadNumbers);

            $.get(Routing.generate('get_data_by_cad_numbers') + query)
                .done(response => {
                    var objects = JSON.parse(response.data);
                })
        });
    }

    /***************************************************************************
     *                              Functions
     **************************************************************************/
    setCadNumbers = numbers => {
        this.cadNumbers = numbers;
    }
}