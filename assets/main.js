;
//alert('test from assets file...');


$('document').ready(function() {

    //run when create ajax is end
    $('#new_config').on('pjax:end', function() {

        $.pjax.reload({container:'#config'});  //Reload GridView

        $('#new_config button').text('Create');
        $('#new_config button').css('background-color', '#5cb85c');
        $('#new_config button').css('border-color', '#4cae4c');
    });



    //Cancel Button:
    $('#config').on('click', '.cancel-update-form', function(e){
        e.preventDefault();

        $.pjax.reload({container:'#config'});  //Reload GridView

        $('#new_config button').text('Create');
        $('#new_config button').css('background-color', '#5cb85c');
        $('#new_config button').css('border-color', '#4cae4c');
    });//end click cancel


    //Delete Button:
    $('#config').on('click', '.pjax-delete-link', function(e){
        e.preventDefault();

        var deleteUrl = $(this).attr('delete-url');
        var result = confirm('Delete this item, are you sure?');

        if(result) {
            $.ajax({
                url: deleteUrl,
                type: 'post',
                timeout: 1000,
                error: function(xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            }).done(function(data) {
                $.pjax.reload({container:'#config'});  //Reload GridView
            });
        }
    });//end click delete


    //Edit Button:
    $('#config').on('click', '.pjax-update-link', function(e){

        e.preventDefault();

        var updateUrl = $(this).attr('update-url');
        var result = confirm('Update this item, are you sure?');

        if(result) {
            $.ajax({
                url: updateUrl,
                type: 'get',
                timeout: 1000,
                error: function(xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            }).done(function(data) {
                //set values in form.
                for(var field in data) {
                    $('#config-'+field).val(data[field]);
                }

                //change Create label button and color
                $('#new_config button').text('Update');
                $('#new_config button').css('background-color', '#337ab7');
                $('#new_config button').css('border-color', '#2e6da4');
                $('.action-buttons').append('<button class="btn btn-warning">Cancel</button>');

                //scroll to begin Form
                var elementClick = $('.breadcrumb');
                var destination = $(elementClick).offset().top;
                $('html').animate({ scrollTop: destination }, 500);
            });
        }//end if
    });//end click edit

});//document.ready