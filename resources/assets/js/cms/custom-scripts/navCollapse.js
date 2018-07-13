$(document).ready(function() {
    $('.collapse').each(function () {
        let id = $(this);
        let opened = Helper.parseBool(localStorage.getItem(id[0].id));

        if(opened !== null) {
            if(!opened) {                
                $(this).removeClass('in');
            }else{
                $('#' + id[0].id + '-caret-right').addClass('rotated');
            }
        }

    });

    $('.collapseAble').on('click', function() {
        setTimeout(() => {
            let element = $(this);
            let opened = _.indexOf(element[0].classList, 'collapsed');
            opened = (opened === -1) ? true : false;
            if(opened){
                $(element.data()['target'] + '-caret-right').addClass('rotated');
            }else{
                $(element.data()['target'] + '-caret-right').removeClass('rotated');
            }
            localStorage.setItem(element.data()['target'].replace('#', ''), opened);
        }, 0);
    });
});
    
    