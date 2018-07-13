class Paginator {
    
    constructor(referenceData) {
        this.referenceData = referenceData;
        this.maximumPages = 0;
        this.currentPage =  1;
        this.itemsPerPage = 10;

        this.setMaximumPages();
        this.paginate(this.itemsPerPage, this.currentPage, this.referenceData);

        Event.listen('search:changed', (data) => {
            
            this.referenceData = data;
            this.setMaximumPages();
            this.paginate(this.itemsPerPage, this.currentPage, this.referenceData);
        });

    }

    /**
     * 
     * @param {*} amountPerPage, amount of records per page
     * @param {*} pageNumber, the page number that needs to be displayed
     * @param {*} data, the data that needs to be paginated
     * 
     */
    paginate(amountPerPage, pageNumber, data) {
        let startItemNumber = (amountPerPage * pageNumber) - amountPerPage;
        let paginatedData = data.slice(startItemNumber, startItemNumber + amountPerPage);

        this.broadcastChanges(paginatedData);
    }


    previousPage() {
        if((this.currentPage - 1) <= 0) {
            Notifier.error("Er is geen vorige pagina.");
        } else {
            this.changePageNumber(this.currentPage - 1);
        }
    }

    nextPage() {
        if((this.currentPage + 1) > this.maximumPages) {
            Notifier.error("Er is geen volgende pagina.");
        }else{
            this.changePageNumber(this.currentPage + 1);
        }
    }

    changePageNumber(pageNumber) {
        this.currentPage = pageNumber;
        this.paginate(this.itemsPerPage, this.currentPage, this.referenceData)
    }

    changeItemsPerPage() {
        this.setMaximumPages();
        if(this.currentPage > this.maximumPages){
            this.currentPage = this.maximumPages;
        }
        this.paginate(this.itemsPerPage, this.currentPage, this.referenceData)
    }

    setMaximumPages() {
        this.maximumPages = Math.ceil(this.referenceData.length / this.itemsPerPage);
    }

    broadcastChanges(data) {
        Event.fire('paginator:changed', data);
    }
}
    
export default Paginator;