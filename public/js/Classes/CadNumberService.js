class CadNumberService {
    /***************************************************************************
     *                                Buttons
     **************************************************************************/
    getCadNumberButton = document.getElementById('get_cad_numbers_button');
    getExcelFilesButton = document.getElementById('get_excel_files_button');
    getExcelFormButton = document.getElementById('get_excel_form_button');
    /***************************************************************************
     *                                 Divs
     **************************************************************************/
    selectedExcelFileName = document.getElementById('selected_file_name');
    leftWindowContent = document.getElementById('left-window-content');
    rightWindowContent = document.getElementById('right-window-content');
    message = document.getElementById('message');

    constructor() {
        this.googleMapsService = new GoogleMapsService();
        this.initHandlers();
    }

    /***************************************************************************
     *                            Init Handlers
     **************************************************************************/
    initHandlers = () => {
       $(this.getExcelFilesButton).on('click', () => {
            this.loadExcelList();
       });

       $(this.getExcelFormButton).on('click', () => {
            this.loadExcelForm();
       });

       $(this.getCadNumberButton).on('click', e => {
           e.preventDefault();
           this.toObtainCadNumbers(this.selectedExcelFileName.innerHTML);
       })
    };

    /***************************************************************************
     *                              Functions
     **************************************************************************/
    loadExcelList = () => {
        $.get(Routing.generate('excel_get_list'))
            .done(response => {
                this.leftWindowContent.innerHTML = response;
            });
    };

    loadExcelForm = () => {
        $.get(Routing.generate('excel_get_form'))
            .done(response => {
                this.leftWindowContent.innerHTML = response;
            });
    };

    selectFile = row => {
        this.selectedExcelFileName.innerHTML = row.innerHTML;
    };

    toObtainCadNumbers = fileName => {
        var query = '?selectedFile=' + fileName;

        $.get(Routing.generate('excel_get_data') + query)
            .done(response => {
                this.rightWindowContent.innerHTML = response.html.content;
                this.googleMapsService.setCadNumbers(response.data);
            });
    }
}