/**
 * Notifier class for notifying the user with a specific message.
 * @type {class}
 */


window.Notifier = new class
{
   constructor() {
      this.vue = new Vue();

      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
      }

      this.toastr = toastr;
    }

  /**
   * Ask the user for a confirmation
   * @param  {[message]}
   * @return {[boolean]}
   */
  askConfirmation(message = null, procceed) {
    
      SweetAlert({
        title: 'Weet u het zeker?',
        text: message,
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Doorgaan",
        cancelButtonText: 'Annuleren',
      },
      function(){
        procceed();
      });
  }


  success(message){
    toastr.clear();
    toastr.success(message);
  }

  info(message) {
    toastr.clear();
    toastr.info(message);
  }


  warning(message){
    toastr.clear();
    toastr.warning(message);
  }

  error(message) {
    toastr.clear();
    toastr.error(message);
  }

  /**
   * Notify the user 
   * @param  {[type]} type of message
   * @param  {[message]} 
   * @return {[void]}
   */
  notify(type, message, title = null) {

  }
}