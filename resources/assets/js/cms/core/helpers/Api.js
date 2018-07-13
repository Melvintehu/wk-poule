  /**
   * Use this class if you want to make call to the API
   * @type {API}
   */
  window.API = new class
  {
     constructor() {
        this.user_id = window.user_id;
        this.vue = new Vue();
        this.vue.data = {
           data: null,
        }
     }

     version() {
       return '/api/';
     }
     

     isAuthorized() {
      
       return window.user_id !== null;
     }

     buildQueryString(parameters) {
      let data = "";

        for(let field in parameters) {
          data += field + '=' + parameters[field] + '&';
        }

        return data.substring(0, data.length - 1);
     }


 
  
      put(base, data){
        return new Promise((resolve, reject) => {
          window.axios.put(this.version() + base, data).then((response) => {
            resolve(response);
          }, reject);
        });
      }

    /**
     * Simple wrapper for vue delete request
     * @param  {[base]} api route
     * @param  {[id]} object id
     * @return {[void]}
     */
     delete(base, id) {
        return new Promise((resolve, reject) => {
          window.axios.delete(this.version() + base + '/' + id, {}).then(resolve, reject);
        });
      }
        

    /**
     * Simple wrapper for vue POST request.
     * @param  {[base]}
     * @return {[Axios http request]}
     */
    post(base, parameters) {

      return new Promise((resolve, reject) => {

        parameters.user_id = this.user_id;

          window.axios.post(this.version() + base, parameters).then( (response) => {
                var data = response.data;
                resolve(data);

            }, reject);
         });

    }


    /**
     * Simple wrapper for vue get request.
     * @param  {[base]}
     * @return {[Axios http request]}
     */
     get(base, parameters = {}) {
        return new Promise((resolve, reject) => {
          window.axios.get(this.version() + base, parameters).then((response) => {
            resolve(response.data); 
          }, reject);
        }); 
     }
  }