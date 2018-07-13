class Search {

    constructor() {

    }

    /**
     * 
     * @param {*} searchValue the value to search for in the data. 
     * @param {*} data, the data to perform the search on.
     * @param {*} attributesToUse, the attributes of the data to search on.
     * 
     * The function skips the attributes that aren't included in the attributesToUse array|object 
     */
    find(searchValue, data, attributesToUse) {
        return _.filter(data, (value, index) => {
            return _.find(attributesToUse, (record, field) => {
                let searchIn = value[field] + '';
                return _.includes(searchIn.toLowerCase(), searchValue.toLowerCase());
            }) !== undefined;   
        });
    }

}

export default Search;